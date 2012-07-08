<?php
// On soustrait du timestamp actuel celui de la dernière modification pour obtenir le nombre de secondes écoulées depuis la dernière modification
$modif_ago = time() - filemtime('cache/etat.cache');
if($modif_ago > 60) 
	{// SI le fichier a été modifié il y a plus d'une minute 
	$fp = @fsockopen($ip, $port, $errno, $errstr, 1);
	if($fp >= 1)
	{$HTML = '<span class="serveurStatusOnline">En ligne</span>';}
	else
	{$HTML = '<span class="serveurStatusOffline">Hors ligne</span>';}
	$fichier = fopen('cache/etat.cache', 'w+');
    // On écrit le code HTML dans le fichier
    fwrite($fichier, $HTML);
    // Pour finir, on coupe la communication avec le fichier
    fclose($fichier);
	}
// On récupère le contenu de notre fichier
$etat = file_get_contents('cache/etat.cache');
// On l'affiche
echo $etat;
?>