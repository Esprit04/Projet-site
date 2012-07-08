<?php
/*Fonctions*/
function connexion () //Module de connexion.
{
try
	{
	require('configuration.php');
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
	//Si on a envoyé le formulaire...
	if (isset ($_POST['nom_utilisateur']))
		{
		//Et si une des entrées était vide, on affiche un message d'erreur et le formulaire.
		if (empty ($_POST['nom_utilisateur']) OR empty ($_POST['mot_de_passe']))
			{
			?>
			<p style="color:#000000;">Veuillez entrer toutes les données demandées.</p>
			<meta http-equiv='refresh' content='1.5; URL='>
			<?php
			}
		//Sinon, on vérifie que le mot de passe rentré est bien lier au nom de compte.
		else
			{
			$verif_compte		=  $bdd->prepare('SELECT pass, level, pseudo FROM accounts WHERE account = :nom_utilisateur');
			$verif_compte 		-> bindValue('nom_utilisateur', $_POST['nom_utilisateur'], PDO::PARAM_STR);
			$verif_compte		-> execute();
			$donnees_compte		=  $verif_compte 	-> fetch();
			$verif_compte 		-> closeCursor();
			//S'il correspond, on stock les informations nécessaire de la base de donnée dans une superglobale de session.
			if ($_POST['mot_de_passe'] == $donnees_compte['pass'])
				{
				$_SESSION['nom_utilisateur']= $_POST['nom_utilisateur'];
				$_SESSION['mot_de_passe'] 	= $donnees_compte['pass'];
				$_SESSION['level'] 			= $donnees_compte['level'];
				$_SESSION['pseudo'] 		= $donnees_compte['pseudo'];
				}
			else //Sinon, on l'indique au visiteur et on le redirige vers le formulaire.
				{
				echo '<p style="color:#000000;">Les identifiants saisis sont incorrects.</p>';
				echo '<meta http-equiv=\'refresh\' content=\'1.5; URL=\'>';
				}
			}
		}
	//Si la variable de session contient quelque chose, on n\'affiche pas le formulaire mais un bouton de déconnexion.
	elseif (isset ($_SESSION['nom_utilisateur']))
		{
		if (isset ($_POST['deconnexion']))
			{
			session_destroy();
			echo '<meta http-equiv=\'refresh\' content=\'0.2; URL=\'>';
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
	}
catch(Exception $e)
	{
	// En cas d'erreur précédemment, on affiche un message et on arrète tout.
	die('Erreur : '.$e->getMessage());
	}
}
function connectes() //Vérification de rang.
{
if (isset ($_SESSION['nom_utilisateur']))
	{		
	echo '	<form method=\'post\' action=\'\'>
			<input name="deconnexion" type="submit" class="button button-blue" value="Se déconnecter"/>
			</form>
			<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="personnages.php"><a href=\'membre.php\'>Espace membre</a><br/>';
	//On vérifie le rang du membre s'il est connecté, s'il n'est pas un simple membre on lui propose un lien vers le Panel.		
	if (($_SESSION['level']) > '1')
		{
		echo '<img src="img/menu/submenuPuce.png" width="20" height="12" alt="Puce"/><a href="personnages.php"><a href=\'panel.php\'>Panel</a><br/>';
		}
	try
		{
		require('configuration.php');
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
		$verif_compte		=  $bdd->prepare('SELECT points FROM accounts WHERE account = :nom_utilisateur');
		$verif_compte 		-> bindValue('nom_utilisateur', $_SESSION['nom_utilisateur'], PDO::PARAM_STR);
		$verif_compte		-> execute();
		$donnees			=  $verif_compte 	-> fetch();
		$verif_compte 		-> closeCursor();
		echo 'Vous avez '.$donnees['points'].' points';
		}
	catch(Exception $e)	
		{
		die('Erreur : '.$e->getMessage());
		}
	}
}
function reduit_texte($texte, $minlen, $maxlen, $separateur = ' ', $suffix = '') //Tronque une chaîne de caractères.
{
$resultat = $texte;
if (strlen($resultat) > $maxlen) 
	{
    if (($pos = strrpos(substr($resultat, 0, $maxlen + strlen( $separateur )), $separateur)) !== false)
		{
        if ($pos < $minlen) 
			{
            $resultat = substr($resultat, 0, $maxlen) . $suffix;
			} 
		else 
			{
			 $resultat = substr($resultat, 0, $pos) . $suffix;
			}
		} 
		else
			{
			$resultat = substr($resultat, 0, $maxlen) . $suffix;
			}
	}
	return $resultat;
}
?>