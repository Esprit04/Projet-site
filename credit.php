<?php
session_start();
require_once('configuration.php');
$ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas='';
$idp = 50451;
$idd = 94965;
$ident=$idp.";".$ids.";".$idd;
if(isset($_POST['code1'])) $code1 = $_POST['code1'];
if(isset($_POST['code2'])) $code2 = ";".$_POST['code2'];
if(isset($_POST['code3'])) $code3 = ";".$_POST['code3'];
if(isset($_POST['code4'])) $code4 = ";".$_POST['code4'];
if(isset($_POST['code5'])) $code5 = ";".$_POST['code5'];
$codes=$code1.$code2.$code3.$code4.$code5;
if(isset($_POST['DATAS'])) $datas = $_POST['DATAS'];
$ident=urlencode($ident);
$codes=urlencode($codes);
$datas=urlencode($datas);
$get_f=@file("http://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas");
if(!$get_f)
{
exit("Votre serveur n'a pas accès au serveur de Starpass, merci de contacter votre hébergeur.");
}
$tab = explode("|",$get_f[0]);

if(!$tab[1]) $url = "http://script.starpass.fr/erreur.php";
else $url = $tab[1];
$pays = $tab[2];
$palier = urldecode($tab[3]);
$id_palier = urldecode($tab[4]);
$type = urldecode($tab[5]);
if(substr($tab[0],0,3) != "OUI")
{
    header("Location: $url");
    exit;
}
else
{
setCookie("CODE_BON", "1", 0);
try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$other	= new PDO('mysql:host='.$hote.';dbname='.$nomBDD_other, $ident_mysql, $mdp_mysql, $pdo_options);
	$req 	=  $other -> prepare('SELECT points FROM accounts WHERE account = :account');
	$req	-> bindValue('account', $_SESSION['nom_utilisateur'], PDO::PARAM_STR);
	$req 	-> execute();
	$donnees= $req->fetch();
	$req 	->closeCursor();
	$req 	= $other->prepare('UPDATE accounts SET points = :points WHERE account = :account');
	$req	->bindValue('points', $donnees['points'] + $points_achat, PDO::PARAM_INT);
	$req	->bindValue('account', $_SESSION['nom_utilisateur'], PDO::PARAM_STR);
	$req	->execute();
	$req 	->closeCursor();
	}
catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
echo 'Code valide, vous avez ete credite.
<meta http-equiv=\'refresh\' content=\'1.5; URL=index.php\'>';
}
?>