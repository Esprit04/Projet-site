<?php
require_once('configuration.php');
//Si le visiteur est connecté.
if (isset ($_SESSION['nom_utilisateur']))
	{
	//On récupère son ip.
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$ip = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
	$req =  $ip->prepare('UPDATE accounts SET LastIP = :ip WHERE pseudo = :pseudo');
	$req -> bindValue('ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
	$req -> bindValue('pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
	$req -> execute();
	$req -> closeCursor();
	}
?>