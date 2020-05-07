<?php
session_start ();
if(empty($_SESSION['email'])||empty($_SESSION['pass'])||empty($_SESSION['prenom'])||empty($_SESSION['nom'])||empty($_SESSION['avatar'])){
    header('location:InterfaceAdmi.php');
}
?>
<?php
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
        <h1  class="message">CRÉEZ ET PARAMÉTREZ VOS QUIZZ</h1>
        <a href="DeconnexionInterAdmin.php"><input type="submit" name="deconnexion" value="Deconnexion" class="decon"></a>
    </div>
    <div id="form">
        
        <div id="bloc1">
           <h1 class="FixerNbreQ"><i>Nbre de question/Jeu</i></h1>
           <form method="POST">
                <input type="number" name="nbre" class="cinq">
                <input type="submit" value="Ok" name="envoyer" class="cinq0">
           </form>
           <div id="AffichageListe">
           <?php
                 $comp=0;  
                 if(isset($_GET['page'])){
                     $page= $_GET['page'];
                 }
                 else{
                     $page= 1;
                 }
                 $nbrparPage=5;
                 $total=count($issa);
                 $nombredepages= ceil($total/$nbrparPage);
                 $min=($page-1)*$nbrparPage;
                 $max=$min+$nbrparPage-1;
                for($i=$min; $i<=$max; $i++){
                    if($issa[$i]['type']=="multiples"){
                        $comp++;
                        $datas=array_keys($issa[$i]['nomcheckbox']);
                        echo $i.".";
                        echo $issa[$i]['quest']."<br/>";
                        foreach($issa[$i]['reponseMultiple'] as $key=>$value){
                            if(in_array($key, $datas)){
                                echo "<input type='checkbox' checked disabled='disabled'>";
                                echo $issa[$i]['reponseMultiple'][$key]."<br/>";
                            }else{
                                echo "<input type='checkbox' disabled='disabled'>";
                                echo $issa[$i]['reponseMultiple'][$key]."<br/>";
                            }
                        }
                    }elseif($issa[$i]['type']=="simple"){
                        $comp++;
                        $data=array_keys($issa[$i]['nomradio']);
                        echo $i.".";
                        echo $issa[$i]['quest']."<br/>";
                        foreach($issa[$i]['reponseSimple'] as $key=>$value){
                            if(in_array($key, $data)){
                                echo "<input type='radio' checked disabled='disabled'>";
                                echo $issa[$i]['reponseSimple'][$key]."<br/>";
                            }else{
                                echo "<input type='radio' disabled='disabled'>";
                                echo $issa[$i]['reponseSimple'][$key]."<br/>";
                            }
                        }
                    }elseif($issa[$i]['type']=="texte"){
                        $comp++;
                        echo $i.".";
                        echo $issa[$i]['quest']."<br/>";?>
                        <textarea type="texteara" cols="19" rows="2" class="AffArea" checked disabled="disabled"><?php echo @$issa[$i]["area"]; ?></textarea><br/>
                <?php }
            }
           ?></div>
           <div class="buton">
           <?php
                if($page>1){?>
                    <button type="submit" name="precedent" class="precedent" id="precedent"><a href="ListeQuestion.php?page=<?= $page-1?>">PRECEDENT</a></button><?php
                }   
                else{
                    echo "";
                } 
                if($comp<$nbrparPage){
                    echo "";
                }
                else{?>
                    <button type="submit" name="suivant" class="suivant" id="suivant"><a href="ListeQuestion.php?page=<?= $page+1?>">SUIVANT</a></button><?php  
                }
            ?>
            </div>
        
        </div>
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
