<?php
//On vérifie si l'ip du membre est bannit.
try
	{
	require('configuration.php');
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
	//On vérifie si l'ip du membre est bannit.
	$ban_ip			=  $bdd->prepare('SELECT COUNT(adresse_ip) AS ip FROM bannis WHERE adresse_ip = :ip LIMIT 0,1');
	$ban_ip 		-> bindValue('ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
	$ban_ip			-> execute();
	$donnees		=  $ban_ip -> fetch();
	$ban_ip 		-> closeCursor();
	//On vérifie si le compte du membre est bannit.
	if (isset ($_SESSION['nom_utilisateur']))
		{
		$ban_compte		=  $bdd->prepare('SELECT COUNT(pseudo) AS compte FROM bannis WHERE pseudo = :pseudo LIMIT 0,1');
		$ban_compte 	-> bindValue('pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
		$ban_compte		-> execute();
		$ban			=  $ban_compte -> fetch();
		$ban_compte 	-> closeCursor();
		}
	}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
?>