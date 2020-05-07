<?php
session_start ();
if(empty($_SESSION['email'])||empty($_SESSION['pass'])||empty($_SESSION['prenom'])||empty($_SESSION['nom'])||empty($_SESSION['avatar'])){
    header('location:InterfaceAdmi.php');
}
$json = file_get_contents("Question.json");
$issa = json_decode($json, true);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Mystyle.css">
	<title></title>
</head>
<body>
    <div id="hautp"><img src="images/logo-QuizzSA.png" class="logo"><label class="plaisir">Le plaisir de jouer</label></div>
    <div id="imgbac"> </div>
    <div id="bar">
        <img src="<?php echo $_SESSION['avatar']; ?>" class="profilUser">
        <label  class="nameUser"><b><?php echo $_SESSION['prenom']." "; echo $_SESSION['nom']; ?></b></label>
        <h1  class="messageUser">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br/>
                JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</h1>
        <a href="DeconnexionInterAdmin.php"><input type="submit" name="deconnexion" value="Deconnexion" class="decon"></a>
    </div>
    <div class="face">
        <div class="blanc">
            <div class="cadre">
                <div class="carre"></div>
                <?php
                for($i=0; $i<count($issa); $i++){
                    echo $issa[$i]['quest'];
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>