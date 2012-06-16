<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-membre</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' href='style/style.css' />
	<meta http-equiv='content-language' content='fr' />
	<meta name='author' content='Esprit' />	
</head>

<body>
<?php include('includes/verif_ban.php');
if ($donnees['ip'] > 0 OR isset ($ban['compte']) AND $ban['compte'] > 0)
	{
	echo 'Vous avez été bannit.';
	}
else
	{
	?>
	<nav>
	<a href='accueil.php'>Accueil</a> |
	<a href='livre.php'>Livre d'or</a>
	<?php   if (!isset ($_SESSION['nom_de_compte']))
	{  echo '<a href=\'inscription.php\'>Inscription</a>';}
	verif_rang();
	echo '</nav> <div class=\'membre\'>';
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		if (isset ($_SESSION['nom_de_compte'])) //Si le visiteur est connecté
			{
			include('includes/recup_ip.php');
			include('includes/verif_ban.php');
			?>
			<h4>Espace membre</h4>
			<form method='post' action=''>
			<p>
			<input type='text' id='nouveau_pseudo' name='nouveau_pseudo' value='Nouveau pseudonyme' onfocus="javascript:if(this.value == 'Nouveau pseudonyme') this.value=''" onblur="javascript:if(this.value=='')this.value='Nouveau pseudonyme'"></br></br>
			<input type='text' id='mdp' name='mdp' value='Mot de passe actuel' onfocus="javascript:if(this.value == 'Mot de passe actuel') this.value=''" onblur="javascript:if(this.value=='')this.value='Mot de passe actuel'"></br> 
			<input type='text' id='nouv_mdp' name='nouv_mdp' value='Nouveau mot de passe' onfocus="javascript:if(this.value == 'Nouveau mot de passe') this.value=''" onblur="javascript:if(this.value=='')this.value='Nouveau mot de passe'"></br>
			<input type='text' id='verif_mdp' name='verif_mdp' value='Nouveau mot de passe' onfocus="javascript:if(this.value == 'Nouveau mot de passe') this.value=''" onblur="javascript:if(this.value=='')this.value='Nouveau mot de passe'"></br>
			<input type='submit' name='valider' id='valider' value='Valider' />
			</p>
			</form>
			<?php
			if (isset ($_POST['nouveau_pseudo'])) //On lui propose de changer de pseudonyme.
				{
				if (empty ($_POST['nouveau_pseudo']) OR ($_POST['nouveau_pseudo']) == 'Nouveau pseudonyme') //Si le formulaire envoyé est vide ou inchangé, rien n'est changé.
					{
					}
				else //Sinon, on change le pseudonyme.
					{
					$req =  $bdd -> prepare('UPDATE comptes SET pseudo = :pseudo WHERE nom_de_compte = :ndc');
					$req -> bindValue('pseudo', $_POST['nouveau_pseudo'], PDO::PARAM_STR);
					$req -> bindValue('ndc', $_SESSION['nom_de_compte'], PDO::PARAM_STR);
					$req -> execute();
					$req -> closeCursor();
					session_destroy();
					echo 'Votre pseudonyme viens d\'être modifié avec succès, veuillez vous reconnecter après la redirection.
					<meta http-equiv=\'refresh\' content=\'2; URL=accueil.php\'>';
					}
				}
			if (isset ($_POST['mdp'])) //On lui propose de changer de mot de passe.
				{
				if (empty ($_POST['mdp']) OR empty ($_POST['nouv_mdp']) OR empty ($_POST['verif_mdp'])) //On vérifie que le formulaire envoyé ne soit pas vide.
					{
					}
				elseif (($_POST['mdp']) == 'Mot de passe actuel' OR ($_POST['nouv_mdp']) == 'Nouveau mot de passe' OR ($_POST['verif_mdp']) == 'Nouveau mot de passe') //On vérifie aussi qu'il n'y est pas des informations par défaut.
					{
					}
				else
					{
					if (($_POST['mdp'])!= $_SESSION['mot_de_passe'] OR ($_POST['nouv_mdp'])!= ($_POST['verif_mdp'])) //On vérifie que le mot de passe actuel soit bien le bon, et que les deux mots de passes entrées soient les mêmes.
						{
						echo 'Les données concernants votre changement de mot de passe sont érronées.';
						}
					else //Si tout correspond, on modifie le mot de passe.
						{
						$req 		=  $bdd->prepare('UPDATE comptes SET mot_de_passe = :mdp WHERE nom_de_compte = :ndc');
						$req		-> bindValue('mdp', $_POST['nouv_mdp'], PDO::PARAM_STR);
						$req		-> bindValue('ndc', $_SESSION['nom_de_compte'], PDO::PARAM_STR);
						$req 		-> execute();
						$req 		-> closeCursor();
						session_destroy();
						echo 'Votre mot de passe viens d\'être modifié avec succès, veuillez vous reconnecter après la redirection.
						<meta http-equiv=\'refresh\' content=\'2; URL=accueil.php\'>';
						}
					}
				}
			}
		else // Si le visiteur est déconnecté on lui propose une page de récupération de mot de passe.
			{
			?>
			<h4>Mot de pase oublié :</h4>
			<form method='post' action=''>
			<p>
			<input type='text' id='nom_de_compte' name='nom_de_compte' value="<?php if (isset ($_POST['nom_de_compte'])){ echo $_POST['nom_de_compte'];} else {echo 'Nom de compte';} ?>" onfocus="javascript:if(this.value == 'Nom de compte') this.value=''" onblur="javascript:if(this.value=='')this.value='Nom de compte'">
			</p>
			</form>
			<?php
			if (isset ($_POST['nom_de_compte']))  //On récupère les données de la base de données.
				{
				$req	=  $bdd->prepare('SELECT nom_de_compte, mot_de_passe, question_secrete, reponse_secrete FROM comptes WHERE nom_de_compte = :ndc');
				$req	-> bindValue('ndc', $_POST['nom_de_compte'], PDO::PARAM_STR);
				$req 	-> execute();
				$donnees=  $req -> fetch();
				$req 	-> closeCursor();
				if (isset ($donnees['nom_de_compte'])) //Si le compte existe on affiche sa question secrète.
					{
					echo $donnees['question_secrete'];
					?>
					<form method='post' action=''>
					<p>
					<input type='text' id='reponse_secrete' name='reponse_secrete' value='Réponse secrète' onfocus="javascript:if(this.value == 'Réponse secrète') this.value=''" onblur="javascript:if(this.value=='')this.value='Réponse secrète'">
					<input type='hidden' name='nom_de_compte' value="<?php if (isset ($_POST['nom_de_compte'])){ echo $_POST['nom_de_compte'];} else {echo 'Nom de compte';} ?>">
					</p>
					</form>
					<?php
					if (isset ($_POST['reponse_secrete']))
						{
						if ($donnees['reponse_secrete'] == $_POST['reponse_secrete']) //Si il a trouvé sa réponse secrète, on lui redonne son mot de passe.
							{
							echo 'Votre mot de passe est : \''.strip_tags($donnees['mot_de_passe']). '\'';
							}
						else
							{
							echo 'Vous n\'avez pas retrouvé votre réponse secrète.';
							}
						}
					}
				else
					{
					echo 'Ce compte est inexistant.';
					}
				}
			}
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
	}
?>
</div>
</html>