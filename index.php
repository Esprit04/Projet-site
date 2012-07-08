<?php
session_start(); //On démarre la session.
require_once('configuration.php'); // On inclut la page de configuration.
require_once('fonctions.php'); // On inclut la page de fonctions.
?>
<!DOCTYPE html >
<html>
<head>
	<title><?php echo $nom_serv?></title>
	<meta charset="utf-8" />
	<link rel="stylesheet" media="screen" href="css/form-min.css" type="text/css"/>
	<link rel="stylesheet" media="screen" href="css/stylesheet-min.css" type="text/css"/>
	<link rel="stylesheet" media="screen" href="css/style.css" type="text/css"/>
	<meta http-equiv="content-language" content="fr" />
	<meta name="author-php" content="Esprit" />	
	<meta name="author-html/css" content="Stunt" />
	<meta name="description" content="CMS - Serveur dofus"/>
</head>
<body>
<?php 
include('includes/verif_ban.php'); //On appel l'include qui vérifie si le membre est bannit.
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
<table><tr>
<td class="leftBlue">Etat du serveur:</td>
</tr><tr>
<td class="leftBlue">Niveau de départ :</td>
<td class="leftRight"><?php echo $Niveau_départ?></td>
</tr><tr>
<td class="leftBlue">Niveau maximal :</td>
<td class="leftRight"><?php echo $Niveau_maximal?></td>
</tr></table><table><tr>
<td class="leftBlue">Rate expérience :</td>
<td class="leftRight"><?php echo $Rate_exp?></td>
</tr><tr>
<td class="leftBlue">Rate Kamas :</td>
<td class="leftRight"><?php echo $Rate_kamas?></td>
</tr><tr>
<td class="leftBlue">Rate Drop :</td>
<td class="leftRight"><?php echo $Rate_drop?></td>
</tr><tr>
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
</div></div><br/>
<div class="leftTitles leftTitleVotes"></div>
<div class="left">
<div id="leftImgVotes"><a href="vote.php" class="leftButtons" title="Voter"></a></div><p>
<span class="leftBlue">Informations</span><br/>
Un vote vous rapporte <?php echo $points_vote?> point,<br/>
Les points sont, par la suite, utilisables en boutique.
</p></div><br/>
<div class="leftTitles leftTitlePartenaires"></div>
<div class="left">
<center> <?php echo $partenaires?> </center>
<br/></div><br/><br/></div>
<div id="blockRight">
<div id="blockMenu">
<span id="menuLeftBg"></span>
<span id="menuRightBg"></span>
<div id="menu">
<div class="menu">
<a class="menuButton" href="index.php">Acceuil</a></div>
<div class="menu">
<a class="menuButton">Nous rejoindre</a><div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="rejoindre.php">Comment nous rejoindre ?</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="inscription.php">Inscription</a></span>
<span class="submenuRightBg"></span>
</div></div>
<div class="menu">
<a class="menuButton" href="equipe.php">L'equipe</a></div>
<div class="menu">
<a class="menuButton">Classement</a><div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="personnages.php">Personnages</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="guildes.php">Guildes</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="votes.php">Votes</a></span>
<span class="submenuRightBg"></span>
</div></div>
<div class="menu">
<a class="menuButton" href="chatbox.php">Chatbox</a></div>
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
<a class="menuButton">A propos</a><div>
<span class="submenuLeftBg"></span>
<span class="submenuCenterBg">
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="reglement.php">Règlement</a>
<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="histoire.php">Histoire</a>
</span>
<span class="submenuRightBg"></span>
</div></div></div></div>
<div class="floatClear"></div>
<span id="page-top"></span>
<div id="colLeft">
<div class="colTitle">
<img src="img/blockTitles/newsTitle.jpg" alt="Inscription"/></div>
<?php
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
			echo '<div class=\'nouveaute\'><center class =\'titre\'>'.strip_tags($donnees['titre']). '</center><center class=\'entete\'>Posté par '.strip_tags($donnees['auteur']).' le ' .strip_tags($donnees['date_creation']). '</center><center class=\'img_new\'><img src="img/news/1.jpg" class="newsImg" alt="Actualités 1"/></center><center>' .nl2br(strip_tags($donnees['contenu'])). '</center><a href=\'commentaires.php?id='.strip_tags($donnees['id']).'\'>Commentaires ('.$donnees_comm['comm_nb'].')</a></div>';
			}
		$req -> closeCursor(); // Termine le traitement de la requête.
		}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
?>
</div><div id="colRight">
<div class="colTitle"><img src="img/blockTitles/loginTitle.jpg" alt="Compte"/></div>
<div class="colContent" id="connexion">
<div id="show">
<center><center>
<?php connexion();
connectes();
?>
<br/>
</center></div></div>
<div class="colEnd"><img src="img/colEnd.jpg" alt="colEnd"/></div>
</div></div>
<div class="floatClear"><br/><br/></div>﻿<div class="floatClear">
<br/><br/>
</div>
<div id="blockFooter">
<hr/><br/>
<img src="img/tofukaz.png"><br/>
Tout les images sont la propriétés de Ankama Games<br/>
<?php echo $nom_serv;?> n'est en aucun cas un site lié avec Ankama Games.<br/><br/>
</div>
<?php
} ?>
</body>
</html>