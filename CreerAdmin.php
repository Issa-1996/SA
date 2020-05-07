<?php
session_start ();
if(empty($_SESSION['email'])||empty($_SESSION['pass'])||empty($_SESSION['prenom'])||empty($_SESSION['nom'])||empty($_SESSION['avatar'])){
    header('location:InterfaceAdmi.php');
}
?>
<?php
session_start ();
$json = file_get_contents("Base.json");
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
        <h1  class="message">CRÉEZ ET PARAMÉTREZ VOS QUIZZ</h1>
        <a href="DeconnexionInterAdmin.php"><input type="submit" name="deconnexion" value="Deconnexion" class="decon"></a>
    </div>
    <div id="form">
        <div id="bloc1">
        <label class="inscrit"><b>S’INSCRIRE</b></label>
        <label class="culture">Pour vous proposer des quizz</label>
        <div class="formulaire">
            <form method="POST" enctype="multipart/form-data">
                <label class="prenom">Prenom</label><br/>
                <input type="texte" name="prenom" class="input1" required value="<?php echo @$_POST['prenom'];?>">
                <label class="nom">Nom</label><br/>
                <input type="texte" name="nom" required value="<?php echo @$_POST['nom'];?>" class="input2">
                <label class="login">Login</label><br/>
                <input type="texte" name="login" required value="<?php echo @$_POST['login'];?>" class="input3">
                <label class="password">Password</label><br/>
                <input type="password" name="password" required value="<?php echo @$_POST['password'];?>" class="input4">
                <label class="confirm">Confirmation </label><br/>
                <input type="password" name="confirm" required value="<?php echo @$_POST['confirm'];?>" class="input5"><br/>
                <label class="avatar">Avatar </label>
                <input type="file" name="avatar" class="input6"> <br/>
                <input type="submit" name="valider" class="input7">
            </form>
        </div>
        <img src="Membre/avatar/admin.jpg" class="pro">
        <label for="" class="ava">Avatar Admin</label>
        </div>
        <div id="menu">
           <div id="profil"><div id="border"></div><a href="#"><img src="<?php echo $_SESSION['avatar']; ?>" class="tof"></a><label class="name"><?php echo $_SESSION['prenom']."<br/>"; echo $_SESSION['nom']; ?></label></div>
           <div id="pages">
               <a href="AccueilAdmin.php" class="liste0">Tableau de bord <img src="images/icones/ic-liste.png" class="icone0"></a>
               <a href="ListeQuestion.php" class="liste1">Liste question <img src="images/icones/ic-liste.png" class="icone1"></a>
               <a href="#" class="liste2">Créer Admin <img src="images/icones/ic-ajout.png" class="icone2"></a>
               <a href="ListeJoueur.php" class="liste3">Liste joueurs <img src="images/icones/ic-liste.png" class="icone3"></a>
               <a href="InterfaceAdmiQuestion.php" class="liste4">Créer Questions <img src="images/icones/ic-ajout.png" class="icone4"></a>
            </div>
        </div>
   </div>
</body>
</html>
<?php
if(isset($_POST['valider'])){
    if(!empty($_POST['prenom'])){
        if($_POST['password']==$_POST['confirm']){
            for($i=0; $i<count($issa); $i++){
                if($issa[$i]['login']==$_POST['login']){
                    $i=(count($issa)-1);
                    echo "Login existant <br/>";
                }
                else{
                    $i=(count($issa)-1);
                    if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
                        $tailleMax=2097152;
                        $extensionValide= array('jpg','jpeg','gif','png');
                        if($_FILES['avatar']['size']<=$tailleMax){
                            $extensionUpload= strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                            if(in_array($extensionUpload, $extensionValide)){
                                $chemin="Membre/Avatar/".$_SESSION['login'].".".$extensionUpload;
                                $resultat=move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                                if($resultat){
                                    $message=array();
                                    $message['avatar']=$chemin;
                                    $message['role']="admin";
                                    $message['prenom']=$_POST['prenom'];
                                    $message['nom']=$_POST['nom'];
                                    $message['login']=$_POST['login'];
                                    $message['password']=$_POST['password'];
                                    $message['confirm']=$_POST['confirm'];
                                    $js=file_get_contents("Base.json");
                                    $js=json_decode($js);
                                    $js[]=$message;
                                    $js=json_encode($js);
                                    file_put_contents("Base.json", $js);
                                }else{
                                    echo "erreur durant l'importation de votre photo";
                                }
                            }else{
                                echo "votre photos de profil doit etre au format png, png, jpg ou jpeg";
                            }
                        }else{
                            echo "votre photos de profil ne doit pas depasser 2Mo";
                        }
                    }
                }
            }
        }else echo "les deux mot de pass ne sont pas identique";
    }
}
?>