<?php
//Si le visiteur est connecté.
if (isset ($_SESSION['nom_de_compte']))
	{
	//On récupère son ip.
	$req =  $bdd->prepare('UPDATE comptes SET derniere_ip = :ip WHERE pseudo = :pseudo');
	$req -> bindValue('ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
	$req -> bindValue('pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
	$req -> execute();
	$req -> closeCursor();
	}
?>