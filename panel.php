<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-panel</title>
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
	<a href='livre.php'>Livre d'or</a> |
	<a href='membre.php'>Espace membre</a>
	</nav>
	<div class='panel'>
	<?php
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		if (isset ($_SESSION['nom_de_compte'])) //On vérifie que le visiteur soit connecté.
			{
			include('includes/recup_ip.php');
			if ($_SESSION['rang'] == 'membre') //Si le visiteur est un simple membre, il est redirigé.
				{
				header('Location: accueil.php');
				}
			if ($_SESSION['rang'] == 'administrateur') //S'il est administrateur, il a accès à la gestion des nouveautés et aux changements de rangs.
				{
				?>
				<h4>Poster une nouveauté :</h4>
				<form method='post' action=''>
				<p>
				<input type='text' id='titre' name='titre' value='Titre' onfocus="javascript:if(this.value == 'Titre') this.value=''" onblur="javascript:if(this.value=='')this.value='Titre'">
				<label for='nouveauté'><br/></label><textarea name='nouveauté' id='nouveauté' rows='2' cols='17' name='nouveautée'>Nouveauté</textarea> <br/>
				<input type='submit' name='envoyer' id='envoyer' value='Envoyer' />
				</p>
				</form>
				<?php
				if (isset ($_POST['titre'])) //S'il a posté une nouveauté
					{
					if (empty ($_POST['titre']) OR empty ($_POST['nouveauté']) OR ($_POST['titre'] =='Titre') OR ($_POST['nouveauté'] =='Nouveauté'))
						{
						echo 'Veuillez rentrer toutes les données nécessaires et ne pas laisser les valeurs par défaut.';
						}
					else //et qu'elle est conforme, on l'insère.
						{	
						$req =  $bdd->prepare('INSERT INTO nouveautes(auteur, titre, contenu, date_creation) VALUES(:auteur, :titre, :contenu, NOW())');
						$req -> bindValue('auteur', $_SESSION['pseudo'], PDO::PARAM_STR);
						$req -> bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
						$req -> bindValue('contenu', $_POST['nouveauté'], PDO::PARAM_STR);
						$req -> execute();
						$req -> closeCursor();
						echo 'Nouveauté envoyé';	
						}
					}
				?>
				<h4>Gestion des nouveautés</h4>
				<?php	
				/* Affichage des nouveautés. */
				// On récupère les messages de la table nouveautés et on les affichent.
				$req =  $bdd->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date FROM nouveautes ORDER BY id DESC LIMIT 0, :offset'); //On récupère les X premières.
				$req -> bindValue('offset', $nb_nouv_panel, PDO::PARAM_INT);
				$req -> execute();
				while ($donnees = $req->fetch())
					{//On récupère l'id de la nouveauté et on le met en paramètre sur l'image de suppréssion et le lien de modification.
					echo '<a href=\'?id='.strip_tags($donnees['id']).'\'><img src=\'style/images/supp.png\' alt=\'Suppréssion\'/></a><span class=\'gestion_nouveaute\'>' .strip_tags($donnees['titre']). ' posté par '.strip_tags($donnees['auteur']).' le ' .strip_tags($donnees['date']). ' : ' .reduit_texte(strip_tags($donnees['contenu']), 15, 200, ' ', ' […]'). ' | <a href=\'?modif='.strip_tags($donnees['id']).'\'>Modifier</a></span></br>';
					}
				$req->closeCursor(); // Termine le traitement de la requête.
				//Si l'utilisateur a envoyé un paramètre id, et que celui-ci est numérique, on supprime la nouveauté correspondante.
				if (isset ($_GET['id']) AND is_numeric($_GET['id']))
					{	
					$req 	=  $bdd->prepare('DELETE FROM nouveautes WHERE id= :id');
					$req	-> execute(array('id' => $_GET['id']));
					$req	-> closeCursor();
					header('Location: panel.php');
					}
				//Si l'utilisateur a envoyé un paramètre modif, et que celui-ci est numérique, on lui donne accès à la modification de nouveauté.
				if (isset ($_GET['modif']) AND is_numeric($_GET['modif']))
					{
					$req =  $bdd->prepare('SELECT contenu, titre FROM nouveautes WHERE id =:modif');
					$req -> execute(array('modif' => $_GET['modif']));
					$donnees = $req->fetch();
					echo '
					<form method=\'post\' action=\'\'>
					<label for=\'modif_titre\'><br/></label><textarea name=\'modif_titre\' id=\'modif_titre\' rows=\'1\' cols=\'45\' name=\'modif_titre\'>'.$donnees['titre'].'</textarea> <br/>
					<label for=\'modif_nouveauté\'><br/></label><textarea name=\'modif_nouveauté\' id=\'modif_nouveauté\' rows=\'5\' cols=\'45\' name=\'modif_nouveauté\'>'.$donnees['contenu'].'</textarea> <br/>
					<input type=\'submit\' name=\'valider\' id=\'valider\' value=\'Valider\' />
					</form>';
					$req->closeCursor();
					if (isset ($_POST['valider']))
						{
						if (empty ($_POST['modif_titre']) OR empty ($_POST['modif_nouveauté']))
							{
							echo 'Veuillez ne rien laisser vide.';
							}
						else //Si toutes les informations sont entrées, on modifie la nouveauté.
							{
							$req =$bdd->prepare('UPDATE nouveautes SET titre = :titre, contenu = :modif_contenu WHERE id = :modif');
							$req->bindValue('titre', $_POST['modif_titre'], PDO::PARAM_STR);
							$req->bindValue('modif_contenu', $_POST['modif_nouveauté'], PDO::PARAM_STR);
							$req->bindValue('modif', $_GET['modif'], PDO::PARAM_INT);
							$req->execute();
							$req->closeCursor();
							echo 'La nouveauté a été modifié avec succès.<meta http-equiv=\'refresh\' content=\'1; URL=panel.php\'>';
							}
						}
					}
				?>
				<h4>Changer le rang d'un membre :</h4>
				<form method='post' action=''>
				<p>
				<input type='text' id='membre' name='membre' value='Pseudo du membre' onfocus="javascript:if(this.value == 'Pseudo du membre') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo du membre'">
				<select name='rang' id='rang'>
				<option value='administrateur'>Administrateur</option>
				<option value='moderateur'>Modérateur</option>
				<option value='membre'>Membre</option>
				</select>
				</p>
				</form>
				<?php
				//Si l'on reçoit un paramètre de formulaire concernant le changement de rang
				if (isset ($_POST['membre']))
					{
					if (empty ($_POST['membre']) OR  empty ($_POST['rang']))
						{
						echo 'Il manque des informations';
						}
					else
						{
						// Et que le message est bien remplit, on vérifie que le pseudo est utilisé par un membre
						$verif_membre		=  $bdd->prepare('SELECT COUNT(pseudo) AS membre_nb FROM comptes WHERE pseudo = :membre LIMIT 0,1');
						$verif_membre 		-> bindValue('membre', $_POST['membre'], PDO::PARAM_STR);
						$verif_membre		-> execute();
						$donnees			=  $verif_membre -> fetch();
						$verif_membre		-> closeCursor();
						//Si c'est le cas, le rang est changé.
						if ($donnees['membre_nb'] >= 1)
							{
							$req =  $bdd->prepare('UPDATE comptes SET rang = :rang WHERE pseudo = :membre');
							$req -> bindValue('rang', $_POST['rang'], PDO::PARAM_STR);
							$req -> bindValue('membre', $_POST['membre'], PDO::PARAM_STR);
							$req -> execute();
							$req -> closeCursor();
							echo 'Le rang du membre a été changé avec succès.';
							}
						else
							{
							echo 'Aucun membre n\'est inscrit sous ce pseudonyme.';
							}
						}
					}
				}
			//S'il est modérateur, il a accès au bannissement.
			if ($_SESSION['rang'] == 'moderateur' OR $_SESSION['rang'] == 'administrateur')
				{
				?>
				<h4>Changer le statut d'un membre :</h4>
				<form method='post' action=''>
				<p>
				<input type='text' id='pseudonyme' name='pseudonyme' value='Pseudo du membre' onfocus="javascript:if(this.value == 'Pseudo du membre') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo du membre'">
				<select name='statut' id='statut'>
				<option value='bannir'>Bannir</option>
				<option value='déban'>Dé bannir</option>
				</select>
				</p>
				</form>
				<?php
				//Si l'on envoi le formulaire de changement de rang
				if (isset ($_POST['pseudonyme']))
					{
					if (empty ($_POST['pseudonyme']) OR empty ($_POST['statut']))
						{
						echo 'Aucun pseudo rentré.';
						}
					else
						{
						// Et qu'il est bien remplit, on vérifie que le pseudo est utilisé par un membre
						$verif_membre		=  $bdd->prepare('SELECT COUNT(pseudo) AS membre_nb FROM comptes WHERE pseudo = :membre LIMIT 0,1');
						$verif_membre 		-> bindValue('membre', $_POST['pseudonyme'], PDO::PARAM_STR);
						$verif_membre		-> execute();
						$donnees			=  $verif_membre -> fetch();
						$verif_membre		-> closeCursor();
						//Si c'est le cas, le statut est changé.
						if ($donnees['membre_nb'] >= 1)
							{
							//On récupère la derniere_ip.
							$verif_ban		=  $bdd->prepare('SELECT derniere_ip FROM comptes WHERE pseudo = :pseudo');
							$verif_ban 		-> bindValue('pseudo', $_POST['pseudonyme'], PDO::PARAM_STR);
							$verif_ban		-> execute();
							$donnees		=  $verif_ban -> fetch();
							$verif_ban -> closeCursor();
							//Si l'on a choisit de bannir le membre
							if ($_POST['statut'] == 'bannir')
								{
								//On insère l'ip du bannit et son pseudonyme dans la table statut.
								$req =  $bdd->prepare('INSERT INTO bannis(pseudo, adresse_ip) VALUES(:pseudonyme, :ip)');
								$req -> bindValue('pseudonyme', $_POST['pseudonyme'], PDO::PARAM_STR);
								$req -> bindValue('ip', $donnees['derniere_ip'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								echo 'Le statut a été changé.';
								}
							//Si l'on a choisit de le dé bannir
							elseif ($_POST['statut'] == 'déban')
								{
								//On supprime les entrées avec son compte/ip.
								$req =  $bdd->prepare('DELETE FROM bannis WHERE adresse_ip= :ip');
								$req -> bindValue('ip', $donnees['derniere_ip'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								$req =  $bdd->prepare('DELETE FROM bannis WHERE pseudo= :pseudo');
								$req -> bindValue('pseudo', $_POST['pseudonyme'], PDO::PARAM_STR);
								$req -> execute();
								$req -> closeCursor();
								echo 'Le statut a été changé.';
								}
							}
						else
							{
							echo 'Aucun membre n\'est inscrit sous ce pseudonyme.';
							}
						}
					}
				}
			//Si le compte a reçut un changement de rang pendant sa connexion, il recevra un message, et sera redirigé lorsqu'il ira à la page panel.php.
			$changement		=  $bdd->prepare('SELECT rang FROM comptes WHERE pseudo = :pseudo');
			$changement 	-> bindValue('pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
			$changement		-> execute();
			$donnees		=  $changement	-> fetch();
			$changement		-> closeCursor();
			if ($donnees['rang'] != $_SESSION['rang'])
				{
				$_SESSION['rang'] = $donnees['rang'];
				echo '<br/>Votre rang a été changé, vous êtes désormais '.strip_tags($_SESSION['rang']).'<meta http-equiv=\'refresh\' content=\'2; URL=\'>';
				}
			}
		else
			{
			header('Location: accueil.php');
			}
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
	}
?>
</div>
</body>
</html>