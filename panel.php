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
	<link rel='stylesheet' href='css/style.css' />
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
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		$other = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
		if (isset ($_SESSION['nom_utilisateur'])) //On vérifie que le visiteur soit connecté.
			{
			include('includes/recup_ip.php');
			if ($_SESSION['level'] < 2) //Si le visiteur est un simple membre, il est redirigé.
				{
				echo '<meta http-equiv=\'refresh\' content=\'0; URL=index.php\'>';
				}
			if ($_SESSION['level'] >= 4) //S'il est administrateur, il a accès à la gestion des nouveautés et aux changements de rangs.
				{
				?>
				<center><h3>Poster une nouveauté :</h3>
				<form method='post' action=''>
				<p>
				<input type='text' id='titre' name='titre' value='Titre' onfocus="javascript:if(this.value == 'Titre') this.value=''" onblur="javascript:if(this.value=='')this.value='Titre'">
				<label for='nouveauté'><br/></label><textarea name='nouveauté' id='nouveauté' rows='4' cols='58' name='nouveautée'>Nouveauté</textarea> <br/>
				<input type='submit' name='envoyer' id='envoyer' value='Envoyer' class="button button-blue"/>
				</p>
				</form></center>
				<?php
				if (isset ($_POST['titre'])) //S'il a posté une nouveauté
					{
					if (empty ($_POST['titre']) OR empty ($_POST['nouveauté']) OR ($_POST['titre'] =='Titre') OR ($_POST['nouveauté'] =='Nouveauté'))
						{
						echo '<center style="color:black;">Veuillez rentrer toutes les données nécessaires et ne pas laisser les valeurs par défaut.</center>';
						}
					else //et qu'elle est conforme, on l'insère.
						{	
						$req =  $bdd->prepare('INSERT INTO nouveautes(auteur, titre, contenu, date_creation) VALUES(:auteur, :titre, :contenu, NOW())');
						$req -> bindValue('auteur', $_SESSION['pseudo'], PDO::PARAM_STR);
						$req -> bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
						$req -> bindValue('contenu', $_POST['nouveauté'], PDO::PARAM_STR);
						$req -> execute();
						$req -> closeCursor();
						echo '<center style="color:black;">Nouveauté envoyé</center>';	
						}
					}
				?>
				<center><h3>Gestion des nouveautés</h3>
				<?php	
				/* Affichage des nouveautés. */
				// On récupère les messages de la table nouveautés et on les affichent.
				$req =  $bdd->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date FROM nouveautes ORDER BY id DESC LIMIT 0, :offset'); //On récupère les X premières.
				$req -> bindValue('offset', $nb_nouv_panel, PDO::PARAM_INT);
				$req -> execute();
				while ($donnees = $req->fetch())
					{//On récupère l'id de la nouveauté et on le met en paramètre sur l'image de suppréssion et le lien de modification.
					echo '<a href=\'?id='.strip_tags($donnees['id']).'\'><img src=\'img/devtool/supp.png\' alt=\'Suppréssion\'/ onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cette nouveauté?\'));"></a> <span class=\'gestion_nouveaute\'>' .strip_tags($donnees['titre']). ' posté par '.strip_tags($donnees['auteur']).' le ' .strip_tags($donnees['date']). ' : ' .reduit_texte(strip_tags($donnees['contenu']), 15, 200, ' ', ' […]'). ' | <a href=\'?modif='.strip_tags($donnees['id']).'\'>Modifier</a></span></br>';
					}
				$req->closeCursor(); // Termine le traitement de la requête.
				//Si l'utilisateur a envoyé un paramètre id, et que celui-ci est numérique, on supprime la nouveauté correspondante.
				if (isset ($_GET['id']) AND is_numeric($_GET['id']))
					{	
					$req 	=  $bdd->prepare('DELETE FROM nouveautes WHERE id= :id');
					$req	-> execute(array('id' => $_GET['id']));
					$req	-> closeCursor();
					echo '<meta http-equiv=\'refresh\' content=\'0; URL=panel.php\'>';
					}
				//Si l'utilisateur a envoyé un paramètre modif, et que celui-ci est numérique, on lui donne accès à la modification de nouveauté.
				if (isset ($_GET['modif']) AND is_numeric($_GET['modif']))
					{
					$req =  $bdd->prepare('SELECT contenu, titre FROM nouveautes WHERE id =:modif');
					$req -> execute(array('modif' => $_GET['modif']));
					$donnees = $req->fetch();
					echo '
					<form method=\'post\' action=\'\'>
					<label for=\'modif_titre\'><br/></label><textarea name=\'modif_titre\' id=\'modif_titre\' rows=\'1\' cols=\'45\' name=\'modif_titre\'>'.$donnees['titre'].'</textarea> <br/>
					<label for=\'modif_nouveauté\'><br/></label><textarea name=\'modif_nouveauté\' id=\'modif_nouveauté\' rows=\'5\' cols=\'45\' name=\'modif_nouveauté\'>'.$donnees['contenu'].'</textarea> <br/>
					<input type=\'submit\' name=\'valider\' id=\'valider\' value=\'Valider\' class="button button-blue"/>
					</form>';
					$req->closeCursor();
					if (isset ($_POST['valider']))
						{
						if (empty ($_POST['modif_titre']) OR empty ($_POST['modif_nouveauté']))
							{
							echo 'Veuillez ne rien laisser vide.';
							}
						else //Si toutes les informations sont entrées, on modifie la nouveauté.
							{
							$req =$bdd->prepare('UPDATE nouveautes SET titre = :titre, contenu = :modif_contenu WHERE id = :modif');
							$req->bindValue('titre', $_POST['modif_titre'], PDO::PARAM_STR);
							$req->bindValue('modif_contenu', $_POST['modif_nouveauté'], PDO::PARAM_STR);
							$req->bindValue('modif', $_GET['modif'], PDO::PARAM_INT);
							$req->execute();
							$req->closeCursor();
							echo '<meta http-equiv=\'refresh\' content=\'0; URL=panel.php\'>';
							}
						}
					}
				?><br/>
				<h3>Changer le rang d'un membre :</h3>
				<form method='post' action=''>
				<p>
				<input type='text' id='membre' name='membre' value='Pseudo du membre' onfocus="javascript:if(this.value == 'Pseudo du membre') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo du membre'">
				<select name='rang' id='rang'>
				<option value='4'>Administrateur</option>
				<option value='3'>Maître jeu</option>
				<option value='2'>Modérateur</option>
				<option value='1'>Animateur</option>
				<option value='0'>Membre</option>
				</select>
				</p>
				</form></center>
				<?php
				//Si l'on reçoit un paramètre de formulaire concernant le changement de rang
				if (isset ($_POST['membre']))
					{
					if (empty ($_POST['membre']) OR  empty ($_POST['rang']))
						{
						echo '<center style="color:black;">Il manque des informations.</center>';
						}
					else
						{
						// Et que le message est bien remplit, on vérifie que le pseudo est utilisé par un membre
						$verif_membre		=  $other->prepare('SELECT COUNT(pseudo) AS membre_nb FROM accounts WHERE pseudo = :membre LIMIT 1');
						$verif_membre 		-> bindValue('membre', $_POST['membre'], PDO::PARAM_STR);
						$verif_membre		-> execute();
						$donnees			=  $verif_membre -> fetch();
						$verif_membre		-> closeCursor();
						//Si c'est le cas, le rang est changé.
						if ($donnees['membre_nb'] >= 1)
							{
							$req =  $other->prepare('UPDATE accounts SET level = :rang WHERE pseudo = :membre');
							$req -> bindValue('rang', $_POST['rang'], PDO::PARAM_STR);
							$req -> bindValue('membre', $_POST['membre'], PDO::PARAM_STR);
							$req -> execute();
							$req -> closeCursor();
							echo '<center style="color:black;">Le rang du membre a été changé avec succès.</center>';
							}
						else
							{
							echo '<center style="color:black;">Aucun membre n\'est inscrit sous ce pseudonyme.</center>';
							}
						}
					}
				}
			//S'il est modérateur, il a accès au bannissement.
			if ($_SESSION['level'] >= 2)
				{
				?><br/><center>
				<h3>Changer le statut d'un membre :</h4>
				<form method='post' action=''>
				<p>
				<input type='text' id='pseudonyme' name='pseudonyme' value='Pseudo du membre' onfocus="javascript:if(this.value == 'Pseudo du membre') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo du membre'">
				<select name='statut' id='statut'>
				<option value='bannir'>Bannir</option>
				<option value='déban'>Dé bannir</option>
				</select>
				</p>
				</form></center>
				<?php
				//Si l'on envoi le formulaire de changement de rang
				if (isset ($_POST['pseudonyme']))
					{
					if (empty ($_POST['pseudonyme']) OR empty ($_POST['statut']))
						{
						echo 'Aucun pseudo rentré.';
						}
					else
						{
						// Et qu'il est bien remplit, on vérifie que le pseudo est utilisé par un membre
						$verif_membre		=  $other->prepare('SELECT COUNT(pseudo) AS membre_nb FROM accounts WHERE pseudo = :membre LIMIT 0,1');
						$verif_membre 		-> bindValue('membre', $_POST['pseudonyme'], PDO::PARAM_STR);
						$verif_membre		-> execute();
						$donnees			=  $verif_membre -> fetch();
						$verif_membre		-> closeCursor();
						//Si c'est le cas, le statut est changé.
						if ($donnees['membre_nb'] >= 1)
							{
							//On récupère la derniere_ip.
							$verif_ban		=  $other->prepare('SELECT lastIP FROM accounts WHERE pseudo = :pseudo');
							$verif_ban 		-> bindValue('pseudo', $_POST['pseudonyme'], PDO::PARAM_STR);
							$verif_ban		-> execute();
							$donnees		=  $verif_ban -> fetch();
							$verif_ban -> closeCursor();
							//Si l'on a choisit de bannir le membre
							if ($_POST['statut'] == 'bannir')
								{
								//On insère l'ip du banni et son pseudonyme dans la table bannis.
								$req =  $bdd->prepare('INSERT INTO bannis(pseudo, adresse_ip) VALUES(:pseudonyme, :ip)');
								$req -> bindValue('pseudonyme', $_POST['pseudonyme'], PDO::PARAM_STR);
								$req -> bindValue('ip', $donnees['lastIP'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								//On insère l'ip du banni dans la table banip de l'émulateur.
								$req =  $other->prepare('INSERT INTO banip(ip) VALUES(:ip)');
								$req -> bindValue('ip', $donnees['lastIP'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								echo '<center style="color:black;">Le statut a été changé.</center>';
								}
							//Si l'on a choisit de le dé bannir
							elseif ($_POST['statut'] == 'déban')
								{
								//On supprime les entrées avec son compte/ip.
								$req =  $bdd->prepare('DELETE FROM bannis WHERE adresse_ip= :ip');
								$req -> bindValue('ip', $donnees['lastIP'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								$req =  $bdd->prepare('DELETE FROM bannis WHERE pseudo= :pseudo');
								$req -> bindValue('pseudo', $_POST['pseudonyme'], PDO::PARAM_STR);
								$req -> execute();
								$req -> closeCursor();
								$req =  $other->prepare('DELETE FROM banip WHERE ip= :ip');
								$req -> bindValue('ip', $donnees['lastIP'], PDO::PARAM_INT);
								$req -> execute();
								$req -> closeCursor();
								echo '<center style="color:black;">Le statut a été changé.</center>';
								}
							}
						else
							{
							echo '<center style="color:black;">Aucun membre n\'est inscrit sous ce pseudonyme.</center>';
							}
						}
					}
				}
			//Si le compte a reçut un changement de rang pendant sa connexion, il recevra un message, et sera redirigé lorsqu'il ira à la page panel.php.
			$changement		=  $other->prepare('SELECT level FROM accounts WHERE pseudo = :pseudo');
			$changement 	-> bindValue('pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
			$changement		-> execute();
			$donnees		=  $changement	-> fetch();
			$changement		-> closeCursor();
			if ($donnees['level'] != $_SESSION['level'])
				{
				$_SESSION['level'] = $donnees['level'];
				echo '<meta http-equiv=\'refresh\' content=\'0; URL=panel.php\'>';
				}
			}
		else
			{
			echo '<meta http-equiv=\'refresh\' content=\'0; URL=index.php\'>';
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
connectes();
//Si on a envoyé le formulaire de déconnexion, on casse la session et on redirige vers la page d'accueil.
if (isset ($_POST['deconnexion']))
	{
	session_destroy();
	echo '<meta http-equiv=\'refresh\' content=\'0; URL=panel.php\'>';
	}
?><br/>
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
} ?>
</body>
</html>