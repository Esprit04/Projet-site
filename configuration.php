<!------------------|
|Code   : Esprit,	|
|Design : Stunt		|
|------------------->
<?php
//Base de données (nécessaire)
$hote 				= 'localhost'; 	//adresse d'hébergement de mysql.
$nomBDD				= 'projet';		//Nom de la base de données du site.
$nomBDD_other 		= 'onemu';    	//Nom de la base de données de votre émulateur, partie other.
$ident_mysql		= 'root';		//Identifiant (login), le plus souvent (chez un hébergeur gratuit), c'est le même login que vous utilisez pour le FTP.
$mdp_mysql			= '';			//Mot de passe, il y a des chances pour que le mot de passe soit le même que celui que vous utilisez pour accéder au FTP. Sinon, renseignez-vous auprès de votre hébergeur.

//Informations techniques
$idd = 94965; //idd starpass
$points_vote = 50; //point par vote
$points_achat = 300; //point par achat
$lien_vote	 = 'http://rpg-paradize.com/'; //La page de vote consacré à votre serveur, sur RPG.
$chatbox	 = '<embed src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="500" height="400" name="chat" FlashVars="id=176580172" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.shtml" /><br><small></small><br>';//lien de votre chatbox. Créez en une ici : http://www.xat.com/web_gear/chat.php

//Affichage (facultatif mais important)
$nom_serv			= 'Projet';
$Niveau_départ		= 1;
$Niveau_maximal		= 200;
$Rate_exp			= 1;
$Rate_kamas			= 1;
$Rate_drop			= 1;
$Rate_honor			= 1;
$Type_serveur		= 'Dofus1.29';
$joueurs_max 		= 20;
$partenaires= 'Aucun';
$ip = '127.0.0.1'; 	// ip du serveur de jeu (dédié, local, ou autre)
$port= 450;			// port du serveur de jeu (c'est le port entré dans la config.txt dédié à votre émulateur)
include('includes/compteurs_connectes.php');//NPT (ne pas toucher)
$joueurs_co = $connectés['nb_co']; 			//NPT
$place 		= $joueurs_co/$joueurs_max*100; //NPT

//Equipe : (remplacez le pseudo par le(s) membre(s) de votre équipe qui ont ce grade.
$pseudo_staff1 	= 'Esprit, Stunt';$rang1= 'Administrateur';
$pseudo_staff2 	= 'Autre';$rang2 = 'Maître-jeu';
$pseudo_staff3 	= 'Autre';$rang3 = 'Modérateur';
$pseudo_staff4 	= 'Autre';$rang4 = 'Animateur';

//Nombres d'éléments affichés (facultatif)
$nb_nouveautés 		= 5; 	// Nombre de nouveautés affichés à partir de la plus récente dans l'accueil.
$nb_nouv_panel		= 5;	// Nombre de nouveautés affichés à partir de la plus récente dans le panel.
$nb_commentaires	= 20; 	// Nombre de commentaires qui s'affichent à partir du plus récent dans commentaires.php.

//Textes de pages (facultatif)
$histoire = '<i>Non loin de la vallée de de Caina, tout prêt des montagnes enragées du terrible Gourlo, a l’apogée de la guerre entre les deux territoires ennemis Bonta et Brakmar …</i><br/>
<i>Une nouvelle déesse vint à ce manifestée, une déesse d\'une beauté incomparable ... Le nez de
Jiva, les dents de Rushu, elle était magnifique comme le cri d’un piou au petit matin …<br>
<br>Ayant les trais de caractère d’une iop et la combativité d’une sadida, cette jeune déesse,
encore inconnue des habitants du monde des douzes, allait pourtant bientôt déclancher une
des plus grandes guerres que ce monde est connu …</i>
<i>Une guerre m\'étant à rude épreuve qui conque viendrais à si opposer… Celle –ci
provoquerais le déclin de la race humaine, qui à ce jour, avait réussi à survivre au plus
grandes catastrophes …</i>
<i>Rejoignez les légions de la déesse' .$nom_serv.', choisissez votre camp, les stratèges Bontariens, les
fourbes Brakmariens ou les sages Mercenaires et combattez jusqu\'à votre dernier souffle !</i><br/>';