<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-inscription</title>
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
	</nav>
	<div class='inscription'>
	<?php
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		//Si la personne est déjà connecté, on la redirige.
		if (isset ($_SESSION['nom_de_compte']))
			{
			header('Location: accueil.php');
			}
		//Module d'inscription.
		?>
		<br/>Remplissez les informations ci-dessous :
		<form method='post' action=''>
		<p>
		<label for='nom_de_compte'>Votre nom de compte : <br/></label><input type='text' name='nom_de_compte' id='nom_de_compte' value='Nom de compte' onfocus="javascript:if(this.value == 'Nom de compte') this.value=''" onblur="javascript:if(this.value=='')this.value='Nom de compte'" name='nom_de_compte'> <br/>
		<label for='mot_de_passe'>Votre mot de passe : <br/></label><input type='password' name='mot_de_passe' id='mot_de_passe' value='Mot de passe' onfocus="javascript:if(this.value == 'Mot de passe') this.value=''" onblur="javascript:if(this.value=='')this.value='Mot de passe'" name='mot_de_passe'> <br/>
		<label for='pseudo'>Votre pseudonyme : <br/></label><input type='text' name='pseudo' id='pseudo' value='Pseudo' onfocus="javascript:if(this.value == 'Pseudo') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo'"name='pseudo'><br/>
		<label for='question_secrete'>Choisissez votre question secrète :</label><br />
		<select name='question_secrete' id='question_secrete'>
		<option value='Quel est votre jeu favori?'>Quel est votre jeu favori?</option>
		<option value='Quel est votre animal favori?'>Quel est votre animal favori?</option>
		<option value='Quel est votre date de naissance?'>Quel est votre date de naissance?</option>
		<option value='Quel est votre numéro fétiche?'>Quel est votre numéro fétiche?</option>
		</select><br/>
		<label for='reponse_secrete'>Votre réponse secrète : <br/></label><input type='text' name='reponse_secrete' id='reponse_secrete' value='Réponse secrète' onfocus="javascript:if(this.value == 'Réponse secrète') this.value=''" onblur="javascript:if(this.value=='')this.value='Réponse secrète'"name='reponse_secrete'> <br/>
		<input type='submit' name='valider' id='valider' value='Valider' />
		</p>
		</form>
		<?php
		if (!isset ($_POST['nom_de_compte'])) //Si on a pas rentré de nom de compte (donc rien, d'après la verification suivante), on n'insère rien (simplifie la condition suivante).
			{
			}
		//Si il y a des informations manquantes, on les redemande.
		elseif (empty ($_POST['nom_de_compte']) OR empty ($_POST['mot_de_passe']) OR empty ($_POST['pseudo']) OR empty ($_POST['reponse_secrete']) OR empty ($_POST['question_secrete']))
			{
			echo 'Veuillez rentrer toutes les informations!';
			}
		elseif (isset ($_POST['nom_de_compte']))
			{
			//On retourne le nombre de personnes ayant ce nom de compte/pseudonyme.
			$verif_ndc			=  $bdd->prepare('SELECT COUNT(nom_de_compte) AS nom_de_compte_nb FROM comptes WHERE nom_de_compte = :nom_de_compte LIMIT 0,1');
			$verif_pseudo		=  $bdd->prepare('SELECT COUNT(pseudo) AS pseudo_nb FROM comptes WHERE pseudo = :pseudo LIMIT 0,1');
			$verif_ndc			-> bindValue('nom_de_compte', $_POST['nom_de_compte'], PDO::PARAM_STR);
			$verif_pseudo		-> bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
			$verif_ndc			-> execute();
			$verif_pseudo		-> execute();
			$donnees_ndc		=  $verif_ndc	 -> fetch();
			$donnees			=  $verif_pseudo -> fetch();
			$verif_ndc 			-> closeCursor();
			$verif_pseudo 		-> closeCursor();
			//Si personne n'a ce nom de compte (le nombre retourné est inférieur à 1)
			if ($donnees_ndc['nom_de_compte_nb'] < 1  AND $donnees['pseudo_nb'] < 1)
				{
				//On insère les informations dans la base de données.
				$req = $bdd	-> prepare('INSERT INTO comptes(nom_de_compte, mot_de_passe, pseudo, question_secrete, reponse_secrete, rang, derniere_ip) VALUES(:nom_de_compte, :mot_de_passe, :pseudo, :question_secrete, :reponse_secrete, :rang, :ip)');
				$req		-> bindValue('nom_de_compte', $_POST['nom_de_compte'], PDO::PARAM_STR);
				$req		-> bindValue('mot_de_passe', $_POST['mot_de_passe'], PDO::PARAM_STR);
				$req		-> bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
				$req		-> bindValue('question_secrete', $_POST['question_secrete'], PDO::PARAM_STR);
				$req		-> bindValue('reponse_secrete', $_POST['reponse_secrete'], PDO::PARAM_STR);
				$req		-> bindValue('rang', 'membre', PDO::PARAM_STR);
				$req		-> bindValue('ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
				$req		-> execute();
				echo 'Vous avez était enregistré avec succès, vous pouvez maintenant vous connecter.<br/>';
				echo'<meta http-equiv=\'refresh\' content=\'1.5; URL=accueil.php\'>';
				$req -> closeCursor();
				}
			//Si le nombre retouné n'était pas inférieur à 1 (pour le nom de compte), on n'enregistre pas les données.
			if ($donnees_ndc['nom_de_compte_nb'] >= 1)
				{
				echo 'Ce nom de compte est déjà utilisé.<br/>';
				}
			//Pareil pour le pseudo.
			if ($donnees['pseudo_nb'] >= 1)
				{
				echo 'Ce pseudo est déjà utilisé.<br/>';
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
</body>
</html>