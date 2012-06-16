<?php
session_start(); //On démarre la session.
require_once('configuration.php'); // On inclut la page de configuration.
require_once('fonctions.php'); // On inclut la page de fonctions.
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-accueil</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' href='style/style.css' />
	<meta http-equiv='content-language' content='fr' />
	<meta name='author' content='Esprit' />	
</head>

<body>
<?php include('includes/verif_ban.php'); //On appel l'include qui vérifie si le membre est bannit.
//S'il l'est, il n'a accès à rien.
if ($donnees['ip'] > 0 OR isset ($ban['compte']) AND $ban['compte'] > 0)
	{
	echo 'Vous avez été bannit.';
	}
else //Sinon, il a accès au site.
	{
	?>
	<nav> <!-- Liens de navigation. -->
	<a href='livre.php'>Livre d'or</a>
	<?php   if (!isset ($_SESSION['nom_de_compte'])) //Si le visiteur ne s'est pas connecté, on lui propose un lien vers l'inscription.
	{echo ' | <a href=\'inscription.php\'>Inscription</a>';	}	?>
	<?php   if (isset ($_SESSION['nom_de_compte'])) //Si le visiteur s'est connecté, on lui propose un lien vers l'espace membre.
	{echo ' | <a href=\'membre.php\'>Espace membre</a>';	}	?>
	<?php
	verif_rang(); //On appel la fonction de vérification du rang.
	connexion (); //On appel celle du module de connexion.
	echo '</nav>';
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		//On récupère l'ip du membre s'il est connecté.
		include('includes/recup_ip.php');
		/* Affichage des nouveautés. */
		// On récupère les messages de la table nouveautes.
		$req =  $bdd->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date_creation FROM nouveautes ORDER BY id DESC LIMIT 0, :offset'); //On récupère les X premières.
		$req -> bindValue('offset', $nb_nouveautés, PDO::PARAM_INT);
		$req -> execute();
		//Affiche chaque nouveauté.
		while ($donnees = $req->fetch())
			{
			//Compte les commentaires de chaque nouveauté.
			$comm_nb		=  $bdd->prepare('SELECT COUNT(id) AS comm_nb FROM commentaires WHERE id_nouveaute = :id');
			$comm_nb		-> bindValue('id', $donnees['id'], PDO::PARAM_INT);
			$comm_nb		-> execute();
			$donnees_comm	=  $comm_nb	-> fetch();
			$comm_nb		-> closeCursor();
			//Affiche la nouveauté.
			echo '<div class=\'nouveaute\'><span class=\'titre\'>'.strip_tags($donnees['titre']). '</span><br/> <span class=\'entete\'>Posté par '.strip_tags($donnees['auteur']).' le ' .strip_tags($donnees['date_creation']). '</span><br/>' .nl2br(strip_tags($donnees['contenu'])). '<br/><a href=\'commentaires.php?id='.strip_tags($donnees['id']).'\'>Commentaires ('.$donnees_comm['comm_nb'].')</a></div>';
			}
		$req -> closeCursor(); // Termine le traitement de la requête.
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
	}
?>
</body>
</html>