<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-commentaires</title>
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
	<?php   if (!isset ($_SESSION['nom_de_compte']))
	{  echo '<a href=\'inscription.php\'>Inscription</a>';  }  ?>
	<?php   if (isset ($_SESSION['nom_de_compte']))
	{  echo '<a href=\'membre.php\'>Espace membre</a>';  }  ?>
	<?php
	verif_rang();
	connexion ();
	echo '</nav><br/>';
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		include('includes/recup_ip.php');
		//Si le nombre envoyé via GET est numérique
		if (isset ($_GET['id']) AND is_numeric($_GET['id']))
			{
			//On vérifie que la nouveauté existe.
			$verif_id		=  $bdd->prepare('SELECT COUNT(id) AS id_nb FROM nouveautes WHERE id = :id LIMIT 0,1');
			$verif_id		-> execute(array('id' => ($_GET['id'])));
			$donnees		=  $verif_id	-> fetch();
			$verif_id		-> closeCursor();
			if ($donnees['id_nb'] ==1) //Si elle existe
				{
				//On affiche la nouveauté qui correspond.
				$nouveauté =  $bdd -> prepare('SELECT auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date_creation FROM nouveautes WHERE id= :id');
				$nouveauté -> execute(array('id' => ($_GET['id'])));
				$donnees = $nouveauté->fetch();
				echo '<div class=\'nouveaute\'><span class=\'titre\'>'.strip_tags($donnees['titre']). '</span><br/> <span class=\'entete\'>Posté par '.strip_tags($donnees['auteur']).' le ' .strip_tags($donnees['date_creation']). '</span><br/>' .nl2br(strip_tags($donnees['contenu'])). '<br/></div>';
				$nouveauté->closeCursor();
				//Et ses commentaires correspondants.
				$commentaires= $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m à %Hh%imin\') AS date FROM commentaires WHERE id_nouveaute= :id ORDER BY date_commentaire DESC LIMIT 0, :offset'); //On récupère les X premiers.
				$commentaires->bindValue('offset', $nb_commentaires, PDO::PARAM_INT);
				$commentaires->bindValue('id', $_GET['id'], PDO::PARAM_INT);
				$commentaires->execute();
				while ($donnees = $commentaires->fetch())
				{
				echo strip_tags($donnees['auteur']). ' (le '.strip_tags($donnees['date']).') : </br>' .strip_tags($donnees['commentaire']). '<br/>';
				}
				$commentaires->closeCursor();
				if (isset ($_SESSION['nom_de_compte']))
					{
					?>
					<form method='post' action=''>
					<p>
					<input type='text' id='commentaire' name='commentaire'>
					<input type='submit' name='envoyer' id='envoyer' value='Envoyer' />
					</p>
					</form>
					<?php
					//Si l'on envoit un commentaire
					if (isset ($_POST['commentaire']))
						{
						//On compte le nombre de caractères qu'il contient, s'il n'est ni trop long, ni vide, on le stock.
						$commentaire = strlen($_POST['commentaire']);
						if ($commentaire >= 200)
							{
							echo 'Le commentaire envoyé est trop long.';
							}
						elseif ($commentaire ==0)
							{
							echo 'Le commentaire envoyé est vide.';
							}
						else
							{
							$req 	= $bdd->prepare('INSERT INTO commentaires(id_nouveaute, auteur, commentaire,  date_commentaire) VALUES(:id, :auteur, :commentaire, NOW())');
							$req	->bindValue('auteur', $_SESSION['pseudo'], PDO::PARAM_STR);
							$req	->bindValue('commentaire', $_POST['commentaire'], PDO::PARAM_STR);
							$req	->bindValue('id', $_GET['id'], PDO::PARAM_INT);
							$req	->execute();
							$req 	->closeCursor();
							echo 'Le commentaire a été envoyé avec succès.<meta http-equiv=\'refresh\' content=\'1.5; URL=\'>';
							}
						}
					}
				else
					{
					echo '<br/>Vous devez être connecté pour poster un commentaire.';
					}
				}
			else //Si la nouveauté n'existe pas, on redirige.
				{
				header('Location: accueil.php');
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
</body>
</html>