<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title><?php echo $nom_serv;?></title>
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
<b><font color="red">En vous inscrivant et en jouant sur <?php echo $nom_serv;?> serveur, vous déclarez avoir lu et accepté la
présente charte. Il vous est donc impossible de contester une sanction sous prétexte que
vous ne l'avez pas lue, si les raisons de cette sanction sont inscrite ci dessous.</font></b>
<br/><br/>
<img src="img/livre.png" style="float: right;" alt=""/>
Les membres de l'équipe sont des personnes bénévoles qui travaillent par envie pour le
serveur, il est évident que vous leur devez le <b>respect</b> comme toute autre personne.<br/><br/>
- Toute marque d'impolitesse ou d'irrespect envers un des membres de l'équipe et/ou le
serveur est <font color="red">sanctionnée.</font><br/><br/>
- Toutes question destinée à un membre de l'équipe <b>sera correctement formulée ou ne
trouvera pas de réponse.</b><br/><br/>
- Il est <font color="red">interdit</font> de contacter les MJ inutilement pour leur demander une téléportation, des
kamas, de l'équipement etc.<br/><br/>
- Les pseudonymes des personnages joueurs des membres de l'équipe sont confidentiels.<br/><br/>
Il est <font color="red">interdit</font> de les contacter sous ces pseudonymes ou de les divulguer, sous peine de lourdes
santions. (Un MJ, Admin à le droit de profiter comme tous autres joueurs)
<br/><br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Qui contacter et comment ?</legend>
Avant de poster une requête sur le support, n'hésitez pas à demander de l'aide ou des
renseignements auprès des autres joueurs, ainsi que sur le forum. Prenez bien soin d'être le
plus clair possible dans votre requête. <br/><br/>Si la requête est illisible, incompréhensible ou qu'elle
concerne une question traitée de nombreuse fois sur le forum, <b>un MJ a parfaitement le
droit de la supprimer sans la traiter</b>. <br/><br/>Il en va de même pour les demandes qui ne se font
pas par requête, tels que les rapports de bogues (à faire sur notre bugtracker), les demandes de
sanctions ou les réclamations de sanctions (à faire sur le forum, dans les sections réservées a
cela).<br/>
</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Transactions :</font></legend>
Les échanges de comptes ne sont <b>pas cautionnés et déconseillés.</b><br/>En cas d'arnaque vous en
êtes le seul responsable, <b>en aucun cas l'équipe n'interviendra pour restituer le compte.</b>
La vente de compte ou items, kamas, etc... contre des <b>Starpass</b> est <font color="red">strictement interdite</font>,
ainsi que toute autre transaction concernant les Starpass.<br/>
Ceux ci ne sont ni revendables, ni échangeables.<br/><br/>
Les transactions des comptes ou objets fictifs du jeu (items, kamas, etc...) <b>contre de l'argent
réel</b> sont <font color="red">strictement interdites</font>.
</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Charte en jeu :</legend>
Toute utilisation de logiciels tiers est <font color="red">interdite</font> et <font color="red">sanctionnée par une suspension définitive
du compte</font> sans possibilité de revenir sur cette sanction, ainsi que tout acte de complicité de
triche.<br/><br/>
Tout abus de bogue est <font color="red">sanctionné</font>. Tout équipement ou objet récupéré grâce à ce genre
d'abus, <b>se verra immédiatement supprimé et le joueur sera sanctionné.</b><br/><br/>
La mendicité reste tolérée si celle-ci est discrète et sans harcèlement.<br/><br/>
Le multi-compte (Utilisation de plusieurs comptes en même temps par une même personne)
est <b>toléré</b> à condition qu'il ne soit pas utilisé à des fins malhonnêtes (Tel que, sans s'y limiter,
provocation de l'alignement opposé, utilisation des deux comptes en même temps pour
s'aider).
</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Pseudonymes :</legend>
Si vous avez un doute sur la conformité de votre pseudo il est préférable de le changer ou
demander a un membre du staff ce qu'il en pense.<br/><br/>
Tout pseudo en rapport avec la liste suivante est fortement déconseillé voir interdit, en cas
de non respect de cette règle, nous nous réservons le droit de le modifier sans préavis :<br/>
- Se rapprochant de celui d'un membre de l'équipe du serveur.<br/>
- Susceptible de choquer les
joueurs (tels que, sans s'y limiter, en rapport avec la vulgarité, tout caractère obscène, violent,
à connotation sexuelle)<br/>
- Racisme / Ethnie<br/>
- Harcèlement ou diffamation<br/>
- Religions ou figure religieuse<br/>
- Politique ou figure politique - Publicité<br/><br/>
Toute <b>publicité</b> pour un autre serveur ou leur mention (pour faire l'éloge ou la diatribe) est
<font color="red">interdite</font>. <br/>Dans le cas contraire vous risquez une suspension définitive de vôtre compte. Nous
sommes sur <b><?php echo $nom_serv;?> serveur</b>, les autres serveurs ne nous concernent pas.<br/><br/>
Il est <font color="red">interdit</font> <b>d'envoyer des messages privés à un MJ,</b> attendez que ce dernier vous contacte
pour lui répondre.<br/><br/>
Les maîtres de jeu ne <b>valident pas les quêtes non fonctionnelles,</b> sauf à titre exceptionnel.
</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Guildes :</legend>
Les guildes appartiennent à leur créateur, seul celui-ci peut décider de la passation de la
guilde à un autre membre. Les MJ <b>n'interviendront donc pas en cas d'abandon</b> par le
meneur de guilde (sauf en cas de suspension définitive du compte) et les investissements
(maisons, enclos, ...) <b>ne seront pas rendus</b>.<br/><br/>
Les meneurs de guilde sont entièrement responsables de leur guilde, ainsi ils ont la
responsabilité de contrôler ce qui se passe au sein de leur guilde. Si l'une d'elle se révèle être
le refuge d'actes allant à l'encontre de cette charte, <b>elle se verra dissoute sans préavis et les
membres se verront lourdement sanctionnés</b>.</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Canaux de discussions :</legend>
Tout langage autre que le français sur les canaux publiques (général, recrutement,
commerce ...) est <font color="red">interdit</font>.<br/><br/>
Toute exploitation abusive d'un canal de discutions publique (tel que, sans s'y limiter, insulte,
diffamation ou flood) est <font color="red">interdite</font>.<br/><br/>
Les messages entièrement en majuscules sur un canal de discussions sont peu recommandés
car symbolisant la colère. A l'exception d'un usage Rp, ceux-là ne seront pas tolérés.
Chaque joueur mérite le respect sur le serveur.<br/><br/>
Ainsi, les <b>injures</b> envers un joueur sont
<font color="red">interdites</font>.<br/><br/>
Les insultes graves (tel que, sans s'y limiter, le racisme, l'homo phobie) sont
<b> sanctionnées plus lourdement</b>.<br/><br/>
Un MJ sait ce qu'il a à faire. Les joueurs n'ont pas à leur dicter quoi que ce soit. Les réflexions
tels que "MJ go support" lorsqu'un MJ fait son apparition en public ne sont donc pas tolérées.<br/><br/>
<font color="red">Les messages demandant l'aide d'un MJ sur les canaux publics ainsi que les messages privés
envoyés à répétition à un MJ sont interdits</font>. <br/><br/>
Il est donc fortement déconseillé de flooder le
canal lorsqu'un membre de l'équipe y fait son apparition.<br/><br/>
Est considéré comme flood, un message lancé plus de deux fois par minutes sur un canal
public. Est également considéré comme tel la relance d'un MJ sur un canal de discussions ou
en message privé ainsi que toute utilisation de macro de dessins.
</fieldset>
<br/>
<fieldset><legend><img src="img/puceh1c.png" class="icon_text" alt=""/> Sanctions :</legend>
Chacun est <b>entièrement responsable de son compte</b>. En cas de sanction de celui ci, toutes
explications telle que "ce n'est pas moi mais un autre" ne permettront pas de la lever.<br/><br/>
Comme explicité plus haut, <b>les starpass ne sont ni échangeables, ni remboursable,</b> même
après sanction du compte.<br/><br/>
Toute sanction en jeu <b>peut être répercutée sur le forum</b> et inversement.
Les sanctions encourues varient en fonction de la gravité de l'acte et de la récidive.<br/><br/>
Les suspensions définitives s'appliquent <b>également à l'adresse IP</b>.<br/><br/>
Les preuves (tel que les screenshots) falsifiées engendreront <b>une suspension définitive
(forum + jeu) du compte</b> ayant déposé la plainte.<br/><br/>
Tout comportement contraire à l'éthique de <b><?php echo $nom_serv;?> serveur</b> pourra être sanctionnée par
l'équipe sans avertissement préalable.
</fieldset>
</td>
</tr>
</table>
<br>
<div class='clear'>
</div>
</div>
</div><div id="colRight">
<div class="colTitle"><img src="img/blockTitles/loginTitle.jpg" alt="Compte"/></div>
<div class="colContent" id="connexion">
<div id="show">
<center>
<center>
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
	}?>
<br/>
</center>
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
<?php } ?>
</body>
</html>