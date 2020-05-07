<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Mystyle.css">
	<title></title>
</head>
<body>
    <div id="hautp"><img src="images/logo-QuizzSA.png" class="logo"><p class="plaisir">Le plaisir de jouer</p></div>
    <div id="imgbac"> </div>
    <div id="barA">
        <h1  class="messageA">Login Form</h1>
    </div>
   <div id="formA">
        <form method="POST">
            <input type="texte" name="email" class="email1" placeholder="Login" value="<?php echo @$_POST['email'];?>">
            <img src="images/icones/ic-login.png" class="imglogin" >
            <input type="password" name="pass" class="passwordA" placeholder="Password" value="<?php echo @$_POST['pass'];?>">
            <img src="App2/icone-password.png" class="imgpass">
            <input type="submit" name="valider" value="Connexion" class="submit" >
            <label class="inscritA"><a href="CreerJoueur.php">S'inscrire pour jouer?</a></label>
        </form>
</div>
<?php
if(isset($_POST['valider'])){
    if(!empty($_POST['email'])&&(!empty($_POST['pass']))){
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $json = file_get_contents("Base.json");
        $parsed = json_decode($json, true);
        for($i=0; $i<count($parsed); $i++){
            if($parsed[$i]["role"]=="admin"){
                if(($email==$parsed[$i]["login"])&&($pass==$parsed[$i]["password"])){
                    session_start();
                    $_SESSION['email']=$email;
                    $_SESSION['pass']=$pass;
                    $_SESSION['prenom']=$parsed[$i]["prenom"];
                    $_SESSION['nom']=$parsed[$i]["nom"];
                    $_SESSION['login']=$parsed[$i]["login"];
                    $_SESSION['avatar']=$parsed[$i]["avatar"];
                    $_SESSION['password']=$parsed[$i]["password"];
                    //$_SESSION['pass']=$pass;
                    if (isset($email) && isset($pass)) {
                        header('location:AccueilAdmin.php');
                    }
                    else {
                        echo 'Les variables ne sont pas déclarées.';
                    }
                }else echo "<br><script>
                alert('Email ou mots de pass Incorect');
                </script>";
            }elseif($parsed[$i]["role"]=="joueur"){
                if(($email==$parsed[$i]["login"])&&($pass==$parsed[$i]["password"])){
                    session_start();
                    $_SESSION['email']=$email;
                    $_SESSION['pass']=$pass;
                    $_SESSION['prenom']=$parsed[$i]["prenom"];
                    $_SESSION['nom']=$parsed[$i]["nom"];
                    $_SESSION['login']=$parsed[$i]["login"];
                    $_SESSION['avatar']=$parsed[$i]["avatar"];
                    $_SESSION['password']=$parsed[$i]["password"];
                    //$_SESSION['pass']=$pass;
                    if (isset($email) && isset($pass)) {
                        header('location:InterfaceUser.php');
                    }
                    else {
                        echo 'Les variables ne sont pas déclarées.';
                    }
                }else echo "<br><script>
                alert('Email ou mots de pass Incorect');
                </script>";
            }
        }
    }
    else echo "<br><script>
alert('Email ou le mots de pass de doit pas etre vide!!!');
</script>";
}
?>
</body>
</html>