<?php
try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
	//On retourne le nombre de personnes ayant ce nom de compte/pseudonyme.
	$nombres_co			=  $bdd->prepare('SELECT COUNT(logged) AS nb_co FROM accounts WHERE logged = 1');
	$nombres_co			-> execute();
	$connectés			=  $nombres_co	 -> fetch();
	$nombres_co -> closeCursor();	
	}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
?>