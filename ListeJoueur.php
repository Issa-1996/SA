<?php
session_start ();
if(empty($_SESSION['email'])||empty($_SESSION['pass'])||empty($_SESSION['prenom'])||empty($_SESSION['nom'])||empty($_SESSION['avatar'])){
    header('location:InterfaceAdmi.php');
}
?>
<?php
$json = file_get_contents("Base.json");
$List_users = json_decode($json, true);
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
        <form method="POST">
            <div id="bloc1">
                <h1 class="ListeJ"><i>LISTE DES JOUEURS PAR SCORE</i></h1>
                <div id="cadre1">
                    <table>
                        <thead>
                            <th id="nomL">Nom</th>
                            <th id="prenomL">Prénom</th>
                            <th id="scoreL">Score</th>
                        </thead>
                    </table>
                    <table id="lie">
                        <?php
                            $comp=0;  
                            if(isset($_GET['page'])){
                                $page= $_GET['page'];
                            }
                            else{
                                $page= 1;
                            }
                            $nbrparPage=15;
                            $total=count($List_users);
                            $nombredepages= ceil($total/$nbrparPage);
                            $min=($page-1)*$nbrparPage;
                            $max=$min+$nbrparPage-1;
                            arsort($List_users);
                            for ($i=$min; $i<count($List_users); $i++){
                                if ($List_users[$i]['role']=="joueur"){
                                    $comp++;?>
                                    <tr> 
                                        <td><?php echo $List_users[$i]['nom']?> </td>
                                        <td><?php  echo $List_users[$i]['prenom']?></td>
                                        <td><?php  echo $List_users[$i]['score']?></td>
                                    </tr><?php 
                                }
                            } 
                        ?>
                    </table>
                </div>
                <div id="defilement">
                    <?php
                        if($page>1){?>
                            <button type="submit" name="precedent" class="precedentL" id="precedent"><a href="ListeJoueur.php?page=<?= $page-1?>">PRECEDENT</a></button><?php
                        }   
                        else{
                            echo "";
                        } 
                        if($comp<$nbrparPage){
                            echo "";
                        }
                        else{?>
                            <button type="submit" name="suivant" class="suivantL" id="suivant"><a href="ListeJoueur.php?page=<?= $page+1?>">SUIVANT</a></button><?php  
                        }
                    ?>
                </div>
            </div>
        </form>
        <div id="menu">
            <div id="profil"><div id="border"></div><a href="#"><img src="<?php echo $_SESSION['avatar']; ?>" class="tof"></a><label class="name"><?php echo $_SESSION['prenom']."<br/>"; echo $_SESSION['nom']; ?></label></div>
            <div id="pages">
                <a href="AccueilAdmin.php" class="liste0">Tableau de bord <img src="images/icones/ic-liste.png" class="icone0"></a>
                <a href="ListeQuestion.php" class="liste1">Liste question <img src="images/icones/ic-liste.png" class="icone1"></a>
                <a href="CreerAdmin.php" class="liste2">Créer Admin <img src="images/icones/ic-ajout.png" class="icone2"></a>
                <a href="ListeJoueur.php" class="liste3">Liste joueurs <img src="images/icones/ic-liste.png" class="icone3"></a>
                <a href="InterfaceAdmiQuestion.php" class="liste4">Créer Questions <img src="images/icones/ic-ajout.png" class="icone4"></a>
            </div>
        </div>
    </div>
</body>
</html>