<!------------------|
|Code   : Esprit,	|
|Design : 			|
|------------------->
<!-- CSS -->
<style>
.mdp_oublié
{
	font-size: 0.8em;
}
</style>
<!-- Variables (à modifier) -->
<?php
//Base de données (nécessaire)
$hote 				= 'localhost'; 	//adresse d'hébergement de mysql.
$nomBDD 			= 'projet';    	//Nom de la base de donnée.
$ident_mysql		= 'root';		//Identifiant (login), le plus souvent (chez un hébergeur gratuit), c'est le même login que vous utilisez pour le FTP.
$mdp_mysql			= '';			//Mot de passe, il y a des chances pour que le mot de passe soit le même que celui que vous utilisez pour accéder au FTP. Renseignez-vous auprès de votre hébergeur.
//Nombres d'éléments affichés (facultatif)
$nb_nouveautés 		= 5; 	// Nombre de nouveautés affichés à partir de la plus récente dans l'accueil.
$nb_nouv_panel		= 5;	// Nombre de nouveautés affichés à artir de la plus récente dans le panel.
$nb_commentaires	= 20; 	// Nombre de commentaires qui s'affichent à partir du plus récent dans commentaires.php.
$page1				= 12;   // Nombre de messages affichés à partir du plus récent dans le livre d'or, à la première page.
$page2				= 20;   // Nombre de messages affichés à partir du X (X = $page1) plus récent dans le livre d'or, à la page 2.