<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
$user=$_SESSION['email'];
            $pass=$_SESSION['pass'];
if (isset($user) && isset($pass)) {

	// On teste pour voir si nos variables ont bien été enregistrées
	header('location:InterfaceAdmiQuestion.php');
	//echo 'Votre login est '.$_SESSION['email'].' et votre mot de passe est '.$_SESSION['pass'].'.';
	// On affiche un lien pour fermer notre session
	//echo '<a href="DeconnexionInterAdmin.php">Déconnection</a>';
}
else {
	echo 'Les variables ne sont pas déclarées.';
}
?>
