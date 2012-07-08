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
	<link rel="stylesheet" media="screen" href="css/style.css" type="text/css"/>
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
﻿<div id="colLeft">
<div class="colContent">
<?php
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$other = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
		if (isset ($_SESSION['nom_utilisateur'])) //Si le visiteur est connecté
			{
			include('includes/recup_ip.php');
			include('includes/verif_ban.php');
			?>
			<center><h3>Espace membre</h3></center>
<form method='post' action=''>
<p>
<div class='systeme_onglets'>
  <div class='onglets'>
    <span class='onglet_0 onglet' data-onglet='page' id='onglet_page'></span>
    <span class='onglet_0 onglet' data-onglet='pseudo' id='onglet_page'><center><h4>Changer de pseudonyme</h4></center></span>
    <span class='onglet_0 onglet' data-onglet='pass' id='onglet_page'><center><h4>Changer de mot de passe</h4></center></span>
  </div>
  <div class='contenu_onglets'>
      <div class='contenu_onglet' data-onglet='page'>
      </div>
      <div class='contenu_onglet' data-onglet='pseudo'>
        <img width='15' height='15' class='icon_text' src='img/devtool/user.png'>Nouveau pseudonyme :
	    <input type='text' id='nouveau_pseudo' name='nouveau_pseudo' autocomplete='off'>
		<center><input type='submit' name='valid' id='valid' value='Valider' class="button button-blue"/></center>
      </div>
      <div class='contenu_onglet' data-onglet='pass'>
        <img width='15' height='15' class='icon_text' src='img/devtool/construction.png'>Mot de passe actuel :
	    <input type='password' id='mdp' name='mdp' autocomplete='off'/></br> 
	    <img width='15' height='15' class='icon_text' src='img/devtool/construction.png'>Nouveau mot de passe :
	    <input type='password' id='nouv_mdp' name='nouv_mdp' autocomplete='off'></br>
	    <img width='15' height='15' class='icon_text' src='img/devtool/construction.png'>Confirmez :
	    <input type='password' id='verif_mdp' name='verif_mdp' autocomplete='off'></br>
		<center><input type='submit' name='valid' id='valid' value='Valider' class="button button-blue"/></center>
	  </div>
  </div>
</div>
<script src='cache/js.js'></script>
</p>
</form>
			<?php
			if (isset ($_POST['mdp'])) //On lui propose de changer de mot de passe.
				{
				if (empty ($_POST['mdp']) OR empty ($_POST['nouv_mdp']) OR empty ($_POST['verif_mdp'])) //On vérifie que le formulaire envoyé ne soit pas vide.
					{
					}
				elseif (($_POST['mdp'])!= $_SESSION['mot_de_passe'] OR ($_POST['nouv_mdp'])!= ($_POST['verif_mdp'])) //On vérifie que le mot de passe actuel soit bien le bon, et que les deux mots de passes entrées soient les mêmes.
					{
					echo '<center style=\'color:black;\'>Les données concernants votre changement de mot de passe sont erronées.</center>';
					}
				else
					{
						$req 		=  $other->prepare('UPDATE accounts SET pass = :mdp WHERE account = :ndc');
						$req		-> bindValue('mdp', $_POST['nouv_mdp'], PDO::PARAM_STR);
						$req		-> bindValue('ndc', $_SESSION['nom_utilisateur'], PDO::PARAM_STR);
						$req 		-> execute();
						$req 		-> closeCursor();
						session_destroy();
						echo '<center style="color:black;">Votre mot de passe viens d\'être modifié avec succès, veuillez vous reconnecter après la redirection.</center>
						<meta http-equiv=\'refresh\' content=\'2; URL=index.php\'>';
					}
				}
			if (isset ($_POST['nouveau_pseudo'])) //On lui propose de changer de pseudonyme.
				{
				if (empty ($_POST['nouveau_pseudo'])) //Si le formulaire envoyé est vide ou inchangé, rien n'est changé.
					{
					}
				else //Sinon, on change le pseudonyme.
					{
					$req =  $other -> prepare('UPDATE accounts SET pseudo = :pseudo WHERE account = :ndc');
					$req -> bindValue('pseudo', $_POST['nouveau_pseudo'], PDO::PARAM_STR);
					$req -> bindValue('ndc', $_SESSION['nom_utilisateur'], PDO::PARAM_STR);
					$req -> execute();
					$req -> closeCursor();
					session_destroy();
					echo '<center style=\'color:black;\'>Votre pseudonyme a été modifié avec succès, veuillez vous reconnecter après la redirection.</center>
					<meta http-equiv=\'refresh\' content=\'2; URL=index.php\'>';
					}
				}
			}
		else // Si le visiteur est déconnecté on lui propose une page de récupération de mot de passe.
			{
			?>
			<center><h3>Espace membre</h3></center>
			<center><h4 style="color:black;">Récupérer son mot de passe</h4></center>
			<form method='post' action=''>
			<p><center>
			<input type='text' id='nom_de_compte' name='nom_de_compte' value="<?php if (isset ($_POST['nom_de_compte'])){ echo $_POST['nom_de_compte'];} else {echo 'Nom de compte';} ?>" onfocus="javascript:if(this.value == 'Nom de compte') this.value=''" onblur="javascript:if(this.value=='')this.value='Nom de compte'">
			</p></center>
			</form>
			<?php
			if (isset ($_POST['nom_de_compte']))  //On récupère les données de la base de données.
				{
				$req	=  $other->prepare('SELECT account, pass, question, reponse FROM accounts WHERE account = :ndc');
				$req	-> bindValue('ndc', $_POST['nom_de_compte'], PDO::PARAM_STR);
				$req 	-> execute();
				$donnees=  $req -> fetch();
				$req 	-> closeCursor();
				if (isset ($donnees['account'])) //Si le compte existe on affiche sa question secrète.
					{
					echo "<img width='15' height='15' class='icon_text' src='img/devtool/config.png'> ".$donnees['question'];
					?>
					<form method='post' action=''>
					<p>
					<center><input type='text' id='reponse_secrete' name='reponse_secrete' value='Réponse secrète' onfocus="javascript:if(this.value == 'Réponse secrète') this.value=''" onblur="javascript:if(this.value=='')this.value='Réponse secrète'"></center>
					<input type='hidden' name='nom_de_compte' value="<?php if (isset ($_POST['nom_de_compte'])){ echo $_POST['nom_de_compte'];} else {echo 'Nom de compte';} ?>">
					</p>
					</form>
					<?php
					if (isset ($_POST['reponse_secrete']))
						{
						if ($donnees['reponse'] == $_POST['reponse_secrete']) //Si il a trouvé sa réponse secrète, on lui redonne son mot de passe.
							{
							echo '<center style="color:black;">Votre mot de passe est : \''.strip_tags($donnees['pass']). '\'</center>';
							}
						else
							{
							echo '<center style="color:black;">Vous n\'avez pas retrouvé votre réponse secrète.</center>';
							}
						}
					}
				else
					{
					echo '<center style="color:black;">Ce compte est inexistant.</center>';
					}
				}
			}
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
?>
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
	connectes();
	//Si on a envoyé le formulaire de déconnexion, on casse la session et on redirige vers la page d'accueil.
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
	<a href="inscription.php" class="grey small">Créer un compte maintenant !</a>
	<?php
	}?><br/>
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