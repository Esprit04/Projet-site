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
	<script type="text/javascript">
	var RecaptchaOptions={
	lang: 'fr',
	theme: 'white'
	};
	</script>
</head>

<body>
<?php include('includes/verif_ban.php'); //On appel l'include qui vérifie si le membre est bannit.
//S'il l'est, il n'a accès à rien.
if ($donnees['ip'] > 0 OR isset ($ban['compte']) AND $ban['compte'] > 0)
	{
	echo '<p style="font-size=10;">Vous avez été banni.</p>';
	}
else //Sinon, il a accès au site.
{
?>
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
<?php
try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
	include('includes/recup_ip.php');
	if (isset ($_SESSION['nom_utilisateur'])){echo '
	<table width="100%" cellspacing="0" cellpadding="0"><tr><td class="tabTop">
	<span class="newsTitle">Erreur</span><br/><span class="newsAutorDate"></span>
	</td></tr><tr><td><p class="newsContent">
	<center>Vous êtes déjà inscris et connecté.</center>
	</p></td></tr><tr><td valign="top" class="tabBottom"></table><br/>';}
	else {//Module d'inscription.
	?>
	<form method='post' action=''>
	<p>
	<img width='15' height='15' class='icon_text' src='img/devtool/joueur.png'/> Nom de compte :
	<input name="username" id="username" type="text" maxlength="32" autocomplete='off'/>
	<img width='15' height='15' class='icon_text' src='img/devtool/construction.png'/> Mot de passe :
	<input name="password" id="password" type="password" maxlength="40" autocomplete='off'/>
	<img width='15' height='15' class='icon_text' src='img/devtool/construction.png'/> Confirmez  :
	<input name="password_conf" id="password_conf" type="password" maxlength="40" autocomplete='off'/>
	<img width='15' height='15' class='icon_text' src='img/devtool/user.png'/> Pseudo :
	<input name="pseudo" id="pseudo" type="text" autocomplete='off'/>
	<img width='15' height='15' class='icon_text' src='img/devtool/email_open.png'/> Adresse E-mail :
	<input name="email" id="email" type="text" autocomplete='off'/>
	<td><img width='15' height='15' class='icon_text' src='img/devtool/config.png'/> Question secrète :<br/>
	<select name="ques"><option value="Nom de ma boisson préféré :"/>Nom de ma boisson préféré :</option><option value="Nom de mon acteur favori :">Nom de mon acteur favori :</option><option value="Nom de mon grand-père :">Nom de mon grand-père :</option><option value="Le premier travail de ma mère :">Le premier travail de ma mère :</option><option value="Lieu de naissance de mon père :">Lieu de naissance de mon père :</option><option value="Ma chanson favorite :">Ma chanson favorite :</option></select><br/><img width='15' height='15' class='icon_text' src='img/devtool/config.png'> Réponse secrète :
	<input name="rep" id="rep" type="text" autocomplete='off'/>
	<center>
	<?php
	require_once('includes/recaptchalib.php');
	$publickey = "6LdVKtMSAAAAAM3Fp8NAFthhONVtgKRULPU7LORn";
	echo recaptcha_get_html($publickey)
	?>
	<tr>
	<td></td><center><td><input type="submit" name="send" class="button button-blue" value="Inscription"></center>
	</td></tr></table><br/>
	</p>
	</form>
	<?php
	$privatekey = "6LdVKtMSAAAAAKLJbsnC0JiYqvpkNFEDxIq_wP3a";
	if (isset ($_POST['recaptcha_challenge_field']))
		{
		$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid)
			{
			echo '<p style="color:#000000;">Le code de vérification est invalide.</p>';
			}
		else
			{
			if (!isset ($_POST['username'])) //Si on a pas rentré de nom de compte (donc rien, d'après la verification suivante), on n'insère rien (simplifie la condition suivante).
				{
				}
			//Si il y a des informations manquantes, on les redemande.
			elseif (empty ($_POST['username']) OR empty ($_POST['password']) OR empty ($_POST['password_conf']) OR empty ($_POST['pseudo']) OR empty ($_POST['email']) OR empty ($_POST['ques']) OR empty ($_POST['rep']))
				{
				echo '<p style="color:#000000;">Veuillez rentrer toutes les informations!</p>';
				}
			elseif ($_POST['password'] != $_POST['password_conf'])
				{
				echo '<p style="color:#000000;">Veuillez rentrer deux mots de passe identiques!</p>';
				}
			elseif (isset ($_POST['username']))
				{
				//On retourne le nombre de personnes ayant ce nom de compte/pseudonyme.
				$verif_ndc			=  $bdd->prepare('SELECT COUNT(account) AS username_nb FROM accounts WHERE account = :username LIMIT 1');
				$verif_pseudo		=  $bdd->prepare('SELECT COUNT(pseudo) AS pseudo_nb FROM accounts WHERE pseudo = :pseudo LIMIT 1');
				$verif_ndc			-> bindValue('username', $_POST['username'], PDO::PARAM_STR);
				$verif_pseudo		-> bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
				$verif_ndc			-> execute();
				$verif_pseudo		-> execute();
				$donnees_ndc		=  $verif_ndc	 -> fetch();
				$donnees			=  $verif_pseudo -> fetch();
				$verif_ndc 			-> closeCursor();
				$verif_pseudo 		-> closeCursor();
				//Si personne n'a ce nom de compte (le nombre retourné est inférieur à 1)
				if ($donnees_ndc['username_nb'] < 1  AND $donnees['pseudo_nb'] < 1)
					{
					//On insère les informations dans la base de données.
					$req = $bdd	-> prepare('INSERT INTO accounts(account, pass, email, lastIP, question, reponse, pseudo) VALUES(:username, :password, :email, :ip, :ques, :rep, :pseudo)');
					$req		-> bindValue('username', $_POST['username'], PDO::PARAM_STR);
					$req		-> bindValue('password', $_POST['password'], PDO::PARAM_STR);
					$req		-> bindValue('email', $_POST['email'], PDO::PARAM_STR);
					$req		-> bindValue('ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
					$req		-> bindValue('ques', $_POST['ques'], PDO::PARAM_STR);
					$req		-> bindValue('rep', $_POST['rep'], PDO::PARAM_STR);
					$req		-> bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
					$req		-> execute();
					echo '<p style="color:#000000;">Vous avez était enregistré avec succès, vous pouvez maintenant vous connecter.</p><br/>';
					echo'<meta http-equiv=\'refresh\' content=\'1.5; URL=index.php\'>';
					$req -> closeCursor();
					}
				//Si le nombre retouné n'était pas inférieur à 1 (pour le nom de compte), on n'enregistre pas les données.
				if ($donnees_ndc['username_nb'] >= 1)
					{
					echo '<p style="color:#000000;">Ce nom de compte est déjà utilisé.</p><br/>';
					}
				//Pareil pour le pseudo.
				if ($donnees['pseudo_nb'] >= 1)
					{
					echo '<p style="color:#000000;">Ce pseudo est déjà utilisé.</p><br/>';
					}
				}
			}
		}
		}
	}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
?>
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
connectes();
//Si on a envoyé le formulaire de déconnexion, on casse la session.
if (isset ($_POST['deconnexion']))
	{
	session_destroy();
	echo '<meta http-equiv=\'refresh\' content=\'0; URL=index.php\'>';
	}
elseif (!isset ($_SESSION['nom_utilisateur']))
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
<?php
}?>
</body>
</html>