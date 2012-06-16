<?php
session_start();
require_once('configuration.php');
require_once('fonctions.php');
?>
<!DOCTYPE html >
<html>
<head>
	<title>Projet-livre d'or</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' href='style/style.css' />
	<meta http-equiv='content-language' content='fr' />
	<meta name='author' content='Esprit' />	
</head>

<body>
<?php include('includes/verif_ban.php');
if ($donnees['ip'] > 0 OR isset ($ban['compte']) AND $ban['compte'] > 0)
	{
	echo 'Vous avez été bannit.';
	}
else
	{
	?>
	<nav>
	<a href='accueil.php'>Accueil</a> |
	<?php   if (!isset ($_SESSION['nom_de_compte']))
	{  echo '<a href=\'inscription.php\'>Inscription</a>';  }  ?>
	<?php   if (isset ($_SESSION['nom_de_compte']))
	{  echo '<a href=\'membre.php\'>Espace membre</a>';  }  ?>
	<?php
	verif_rang();
	echo '</nav><div class=\'livre\'>';
	/* Affichage du formulaire. */
	if (isset ($_SESSION['msg_incomp'])) //Si on a envoyé un message ne correspondant pas aux critères, on affiche un message d'erreur et on change la valeur de la variable (pour que le message ne soit affiché qu'une fois ; les critères et le contenu de la variable sont dans le livre_envoi.php).
		{
		echo strip_tags($_SESSION['msg_incomp']) . '<br/>';
		$_SESSION['msg_incomp'] = '';
		}
	if (isset ($_GET['page'])) //Si on a envoyé un get[page], le formulaire n'est plus affiché.
		{
		}
	elseif (isset ($_COOKIE['pseudo_value'])) //Lorsque on rentre un pseudo, celui-ci est stocké dans un cookie, ce qui permet de l'afficher en value dans le formulaire pour les prochaines fois.
		{
		?>
		<form method='post'	action='livre_envoi.php'>
		<p>
		<label for='pseudo'>Votre pseudo : <br/></label><input type='text' name='pseudo' id='pseudo' value="<?php echo $_COOKIE['pseudo_value'] ?>" onfocus="javascript:if(this.value == '<?php echo $_COOKIE['pseudo_value'] ?>') this.value=''" onblur="javascript:if(this.value=='')this.value='<?php echo $_COOKIE['pseudo_value'] ?>'"name='pseudo'> <br/><br/>
		<label for='message'>Votre Message : <br/></label><textarea name='message' id='message' rows='2' cols='17' name='message'></textarea> <br/>
		<input type='submit' name='envoyer' id='envoyer' value='Envoyer' />
		</p>
		</form>
		<?php
		}
	else //Sinon, on met le value 'Pseudo', qu'il faudra changer (sinon, le message ne sera pas enregistré car il ne correspondra pas aux critères).
		{
		?>
		<form method='post' action='livre_envoi.php'>
		<p>
		<label for='pseudo'>Votre pseudo : <br/></label><input type='text' name='pseudo' id='pseudo' value='Pseudo' onfocus="javascript:if(this.value == 'Pseudo') this.value=''" onblur="javascript:if(this.value=='')this.value='Pseudo'" name='pseudo'> <br/><br/>
		<label for='message'>Votre Message : <br/></label><textarea name='message' id='message' rows='2' cols='17' name='message'></textarea> <br/>
		<input type='submit' name='envoyer' id='envoyer' value='Envoyer' />
		</p>
		</form>
		<?php
		}
		?>
	<?php
	try
		{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
		include('includes/recup_ip.php');
		/* Affichage des messages. */
		// On récupère les messages de la table minichat et on affiche chaque message.
		if (isset ($_GET['page']) AND ($_GET['page']==2)) //Avec une donnée dans l'url, on affiche la page voulue, ici, 2.
			{
			$req =  $bdd->prepare('SELECT id, pseudo, message, DATE_FORMAT(date_envoi, \'%d/%m à %Hh%imin\') AS date_envoi FROM livre ORDER BY id DESC LIMIT :offset_p1, :offset'); //On récupère les X premiers messages à partir du 11ème plus récent, on formate la date et on affiche le tout.
			$req -> bindValue('offset_p1', $page1, PDO::PARAM_INT);
			$req -> bindValue('offset', $page2, PDO::PARAM_INT);
			$req -> execute();
			while ($donnees = $req->fetch())
			{
			echo strip_tags($donnees['pseudo']). ' (le '.strip_tags($donnees['date_envoi']).') : ' .strip_tags($donnees['message']). '<br/>';
			}
			$req->closeCursor(); // Termine le traitement de la requête.
			}
		else // Sans donnée dans l'url, donc les 10 derniers messages.
			{
			$req =  $bdd->prepare('SELECT id, pseudo, message, DATE_FORMAT(date_envoi, \'%d/%m à %Hh%imin\') AS date_envoi FROM livre ORDER BY id DESC LIMIT 0, :offset'); //On récupère les X premiers message avec leurs dates formatés
			$req -> bindValue('offset', $page1, PDO::PARAM_INT);
			$req -> execute();
			while ($donnees = $req->fetch())
					{
					echo strip_tags($donnees['pseudo']). ' (le '.strip_tags($donnees['date_envoi']).') : ' .strip_tags($donnees['message']). '<br/>';
					}
			$req->closeCursor(); // Termine le traitement de la requête.
			}
		}
	catch(Exception $e)
		{
		die('Erreur : '.$e->getMessage());
		}
	?>
	</div>
	<p class='pages_livre'> page 
	<a class='bouttons' href='livre.php'>1<a/> <a class='bouttons' href='?page=2'>2<a/><!-- on propose différentes pages, avec des get[page]. -->
	</p>
	<?php
	}
?>
</body>
</html>