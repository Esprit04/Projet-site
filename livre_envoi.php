<?php
session_start();
setcookie('pseudo_value', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true); // On écrit dans un cookie le pseudo envoyé via le formulaire.
require_once('configuration.php');
try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
	/* Insertion des messages. */
	if (empty ($_POST['message']) OR ($_POST['pseudo'] =='Pseudo')) //Si le message ne correspond pas aux critères attendues, ici il est soit vide soit le pseudo de base a été laissé (Pseudo), on crée une variable de session qui s'affichera au dessus du formulaire, dans le livre d'or.
		{
		$_SESSION['msg_incomp'] = 'Veuillez rentrer un pseudo autre que "Pseudo" et un message!';
		}
	elseif (isset ($_POST['pseudo']) AND isset ($_POST['message'])) //Si tout est correct on insère le message, la date... via une requète préparée.
		{
		$req =  $bdd->prepare('INSERT INTO livre(pseudo, message, date_envoi) VALUES(:pseudo, :message, NOW())');
		$req -> bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$req -> bindValue('message', $_POST['message'], PDO::PARAM_STR);
		$req -> execute();
		$req -> closeCursor();
		// Puis on redirige vers le le livre d'or.
		}
header('Location: livre.php');
	}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
?>