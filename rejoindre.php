<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title><?php echo $nom_serv?></title>
	<meta charset="utf-8" />
	<link rel="stylesheet" media="screen" href="css/form-min.css" type="text/css"/>
	<link rel="stylesheet" media="screen" href="css/stylesheet-min.css" type="text/css"/>
	<meta http-equiv="content-language" content="fr" />
	<meta name="author-php" content="Esprit" />	
	<meta name="author-html/css" content="Stunt" />
	<meta name="description" content="CMS - Serveur dofus"/>
</head>

<body>
<?php include('includes/verif_ban.php'); //On appel l'include qui vérifie si le membre est bannit.
//S'il l'est, il n'a accès à rien.
if ($donnees['ip'] > 0 OR isset ($ban['compte']) AND $ban['compte'] > 0)
	{
	echo '<p style="font-size=10;">Vous avez été banni.</p>';
	}
else //Sinon, il a accès au site.
{?>
<div id="blockBody">
<div id="blockStatistiques">
<div id="statistiquesToday"><span class="bold contract grey x-small"></span> <span class="blue bold contract xx-small"></span></div>
<div id="statistiquesYesterday"><span class="bold contract grey x-small"></span> <span class="blue bold contract xx-small"></span></div>
<div id="statistiquesTotal"><span class="bold contract grey x-small"></span> <span class="blue bold contract xx-small"></span></div>
<div id="statistiquesOnline"><span class="bold contract grey x-small"></span> <span class="blue bold contract xx-small"></span></div>
</div>
<div id="blockHeader"></div>
<div id="blockLeft">
<div class="leftTitles leftTitleServeur"></div>
<div class="left leftServeur">
<table>
<tr>
<td class="leftBlue">Etat du serveur:</td>
</tr>
<tr>
<td class="leftBlue">Niveau de départ :</td>
<td class="leftRight"><?php echo $Niveau_départ?></td>
</tr>
<tr>
<td class="leftBlue">Niveau maximal :</td>
<td class="leftRight"><?php echo $Niveau_maximal?></td>
</tr>
</table>
<table>
<tr>
<td class="leftBlue">Rate expérience :</td>
<td class="leftRight"><?php echo $Rate_exp?></td>
</tr>
<tr>
<td class="leftBlue">Rate Kamas :</td>
<td class="leftRight"><?php echo $Rate_kamas?></td>
</tr>
<tr>
<td class="leftBlue">Rate Drop :</td>
<td class="leftRight"><?php echo $Rate_drop?></td>
</tr>
<tr>
<td class="leftBlue">Rate Honor :</td>
<td class="leftRight"><?php echo $Rate_honor?></td>
</tr>
</table>
<span class="serveurType"><?php echo $Type_serveur?></span>
<?php 
include_once('includes/etat.php');
?>
<div class="serveurBarBg">
<div class="serveurBar" style="width:<?php echo $place.'%';?>"></div>
<div class="serveurPlayers"><?php echo $joueurs_co.'/' .$joueurs_max;?></div>
</div>
</div>
<br/>
<div class="leftTitles leftTitleVotes"></div>
<div class="left">
<div id="leftImgVotes"><a href="vote.php" class="leftButtons" title="Voter"></a></div>
<p>
<span class="leftBlue">Informations</span><br/>
Un vote vous rapporte <?php echo $points_vote?> point,<br/>
Les points sont, par la suite, utilisables en boutique.
</p>
</div>
<br/>
<div class="leftTitles leftTitlePartenaires"></div>
<div class="left">
<center> <?php echo $partenaires?> </center>
<br/>
</div>
<br/><br/>
</div>
<div id="blockRight">
<div id="blockMenu">
<span id="menuLeftBg"></span>
<span id="menuRightBg"></span>
<div id="menu">
<div class="menu">
<a class="menuButton" href="index.php">Acceuil</a>
</div>
<div class="menu">
<a class="menuButton">Nous rejoindre</a>
<div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="rejoindre.php">Comment nous rejoindre ?</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="inscription.php">Inscription</a>
</span>
<span class="submenuRightBg"></span>
</div>
</div>
<div class="menu">
<a class="menuButton" href="equipe.php">L'equipe</a>
</div>
<div class="menu">
<a class="menuButton">Classement</a>
<div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="personnages.php">Personnages</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="guildes.php">Guildes</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="votes.php">Votes</a>
</span>
<span class="submenuRightBg"></span>
</div>
</div>
<div class="menu">
<a class="menuButton" href="chatbox.php">Chatbox</a>
</div>
<div class="menu">
<a class="menuButton" href="boutique.php">Boutique</a>
<div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="points.php">Achat de points</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="services.php">Services</a>
</span>
<span class="submenuRightBg"></span>
</div></div>
<div class="menu">
<a class="menuButton">A propos</a>
<div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="reglement.php">Règlement</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="histoire.php">Histoire</a>
</span>
<span class="submenuRightBg"></span>
</div>
</div>
</div>
</div>
<div class="floatClear"></div>
<span id="page-top"></span>
<div id="colLeft">
<div class="colContent">
<table width="100%" cellspacing="0" cellpadding="0"><tr>
</tr>
<tr><td>
<center>Vous souhaitez rejoindre la communauté <b><?php echo $nom_serv;?></b> et revivre l'aventure des anciens serveurs officiel d'<b>Ankama</b> ? Vous trouverez ici toutes les informations qu'il vous faut pour nous rejoindre même si vous n'avez pas encore le jeu.<br/><br/>
Si vous n'êtes pas satisfaits de nos services nous vous invitons à vous rendre sur les serveurs officiels, malgré la <b>version 2.0</b>.<br/><br/>
<b><u>Etape nº1: Installation du client.</u></b><br/><br/>
Téléchargez la version 1.29 de Dofus (seulement si vous n'avez pas déjà le client dofus 1.29) <b><font color='red'>est obligatoire</font></b> pour pouvoir accéder au serveur en toute tranquillité.<br/><br/>
<a href='dl/client.exe'><img border='0' src='img/download1.png'></a><br/><br/>
Après avoir téléchargé le client ci-dessus, veuillez le lancer et suivre les instructions pour mener à bien votre installation.<br/><br/>
<b><u>Etape nº2: Lancement du jeu (Config automatique du serveur)</u></b><br/><br/>
<a href='dl/setup.exe'><img border='0' src='img/download2.png'></a><br/><br/>
Remplacez cette configuration à la place de celle se trouvant dans votre racine de votre dossier <b>Dofus</b>.</center>
</td>
</tr>
</table>
<br>
<div class='clear'>
</div>
</div>
</div>
<div id="colRight">
<div class="colTitle"><img src="img/blockTitles/loginTitle.jpg" alt="Compte"/></div>
<div class="colContent" id="connexion">
<div id="show">
<center><center>
<?php
if (isset ($_SESSION['nom_utilisateur']))
	{
	try
		{
		include('includes/recup_ip.php');
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
	connectes();
	//Si on a envoyé le formulaire de déconnexion, on casse la session.
	if (isset ($_POST['deconnexion']))
		{
		session_destroy();
		echo '<meta http-equiv=\'refresh\' content=\'0; URL=\'>';
		}
	}
else
	{
	?>
	<form method="post" action='index.php'><p>
	<label for="id_nom_utilisateur">Nom de compte :</label>
	<input id="id_nom_utilisateur" name="nom_utilisateur" type="text"/>
	</p><p>
	<label for="id_mot_de_passe">Mots de passe :</label>
	<input id="id_mot_de_passe" name="mot_de_passe" type="password"/></p>
	<input name="uniqid" type="hidden" value="menu"/>
	<p><input name="submit" type="submit" class="button button-blue" value="Se connecter"/>
	</p></form>
	<a href="inscription.php" class="grey small">Créer un compte maintenant !</a><br/>
	<a href="membre.php" class="grey small">Mot de passe oublié?</a>
	<?php
	}
?>
<br/></center>
</div>
</div>
<div class="colEnd"><img src="img/colEnd.jpg" alt="colEnd"/></div>
</div>
</div>
<div class="floatClear"><br/><br/></div>﻿<div class="floatClear">
<br/><br/>
</div>
<div id="blockFooter">
<hr/><br/>
<img src="img/tofukaz.png">
<br/>
Tout les images sont la propriétés de Ankama Games<br/>
<?php echo $nom_serv;?> n'est en aucun cas un site lié avec Ankama Games.<br/><br/>
</div>
<?php
}?>
</body>
</html>