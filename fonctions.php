<?php
/*Fonctions*/
function connexion () //Module de connexion.
{
try
	{
	require('configuration.php');
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$nomBDD, $ident_mysql, $mdp_mysql, $pdo_options);
	//Si on a envoyé le formulaire...
	if (isset ($_POST['nom_de_compte']))
		{
		//Et si une des entrées était vide, on affiche un message d'erreur et le formulaire.
		if (empty ($_POST['nom_de_compte']) OR empty ($_POST['mot_de_passe']))
			{
			?>
			<br/>Veuillez entrer toutes les données demandées.
			<meta http-equiv='refresh' content='1.5; URL='>
			<?php
			}
		//Sinon, on vérifie que le mot de passe rentré est bien lier au nom de compte.
		else
			{
			$verif_compte		=  $bdd->prepare('SELECT mot_de_passe, rang, pseudo FROM comptes WHERE nom_de_compte = :nom_de_compte');
			$verif_compte 		-> bindValue('nom_de_compte', $_POST['nom_de_compte'], PDO::PARAM_STR);
			$verif_compte		-> execute();
			$donnees_compte		=  $verif_compte 	-> fetch();
			$verif_compte 		-> closeCursor();
			//S'il correspond, on stock les informations nécessaire de la base de donnée dans une superglobale de session.
			if ($_POST['mot_de_passe'] == $donnees_compte['mot_de_passe'])
				{
				echo '<br/>Connexion réussie';
				$_SESSION['nom_de_compte'] 	= $_POST['nom_de_compte'];
				$_SESSION['mot_de_passe'] 	= $donnees_compte['mot_de_passe'];
				$_SESSION['rang'] 			= $donnees_compte['rang'];
				$_SESSION['pseudo'] 		= $donnees_compte['pseudo'];
				echo'<meta http-equiv=\'refresh\' content=\'1; URL=\'>';
				}
			else //Sinon, on l'indique au visiteur et on le redirige vers le formulaire.
				{
				echo '<br/>Les identifiants saisis sont incorrects.';
				echo '<meta http-equiv=\'refresh\' content=\'1; URL=\'>';
				}
			}
		}
	//Si la variable de session contient quelque chose, on n\'affiche pas le formulaire mais un bouton de déconnexion.
	elseif (isset ($_SESSION['nom_de_compte']))
		{		
		echo '	<form method=\'post\' action=\'\'>
				<input type=\'submit\' name=\'deconnexion\' id=\'deconnexion\' value=\'Déconnexion\' />
				</form>';
		//Si on a envoyé le formulaire de déconnexion, on casse la session et on redirige vers la page d'accueil.
		if (isset ($_POST['deconnexion']))
			{
			session_destroy();
			header('Location: #');
			}
		}
	//Si le formulaire n'a pas été envoyé, on l'affiche.
	else
		{
		?>
		<form method='post' action=''>
		<p>
		Connexion : <br/>
		<input type="text" name="nom_de_compte" id="nom_de_compte" value="Nom de compte" onfocus="javascript:if(this.value == 'Nom de compte') this.value=''" onblur="javascript:if(this.value=='')this.value='Nom de compte'"name='nom_de_compte'> <br/>
		<input type="password" name="mot_de_passe" id="mot_de_passe" value="Mot de passe" onfocus="javascript:if(this.value == 'Mot de passe') this.value=''" onblur="javascript:if(this.value=='')this.value='Mot de passe'"name='mot_de_passe'> <br/>
		<input type='submit' name='envoyer' id='envoyer' value='Envoyer'>
		</p>
		</form>
		<a href='http://localhost/tests/php-mysql/projet/membre.php' class='mdp_oublié'>(Mot de passe oublié?)</a>
		<?php
		}
	}
catch(Exception $e)
	{
	// En cas d'erreur précédemment, on affiche un message et on arrète tout.
	die('Erreur : '.$e->getMessage());
	}
}
function verif_rang() //Vérification de rang.
{
//On vérifie le rang du membre s'il est connecté, s'il n'est pas un simple membre on lui propose un lien vers le Panel.
if (isset ($_SESSION['nom_de_compte']) AND ($_SESSION['rang']) != 'membre')
	{
	echo ' | <a href=\'panel.php\'>Panel</a>';
	}
echo '<br/>';
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