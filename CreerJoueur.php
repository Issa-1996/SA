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
    <div id="hautp"><img src="images/logo-QuizzSA.png" class="logo"><p class="plaisir">Le plaisir de jouer</p></div>   
    <div id="formCJ">
        <label class="inscrit"><b>S’INSCRIRE</b></label>
        <label class="culture">Pour tester votre niveau de culture générale</label>
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
                <label class="confirm">Confirmer password </label><br/>
                <input type="password" name="confirm" required value="<?php echo @$_POST['confirm'];?>" class="input5"><br/>
                <label class="avatar"><b>Avatar </b></label>
                <input type="file" name="avatar" class="input6"> <br/>
                <input type="submit" name="valider" class="input7" value="Creer Compte">
            </form>
        </div>
        <img src="Membre/avatar/admin.jpg" class="pro">
        <label for="" class="ava">Avatar du joueur</label>
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
                                    $message['role']="joueur";
                                    $message['score']=0;
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
                                    echo "<br><script>
                alert('Creer avec succes');
                </script>";
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