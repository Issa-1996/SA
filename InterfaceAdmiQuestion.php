<?php
session_start ();
if(empty($_SESSION['email'])||empty($_SESSION['pass'])||empty($_SESSION['prenom'])||empty($_SESSION['nom'])||empty($_SESSION['avatar'])){
    header('location:InterfaceAdmi.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
    var i=0;
        function hide(){
            document.getElementById('type2').style.display='none';
        }
        var nbrRow=0;
        function onAddinput1(){
            nbrRow++;
            var divInputs=document.getElementById('myDiv');
            var newInput=document.createElement('div');
            var br=document.createElement('br');
            newInput.setAttribute('class', 'division');
            newInput.setAttribute('id', 'row_'+nbrRow);
            newInput.innerHTML=`
            <label value="Reponse"${nbrRow} class="labelRep"><b>Reponse${nbrRow}</b></label>
            <input type="text" class="row" name="reponseMultiple[${nbrRow}]">
            <input type="checkbox" class="classcheckbox" name="nomcheckbox[${nbrRow}]">
                <button type="button" class="supprime" onClick="onDeleteinput(${nbrRow})"></button>`;
            divInputs.appendChild(newInput);
            //document.getElementById('myDiv').appendChild(br);
        }
        function onAddinput2(){
            nbrRow++;
            var divInputs=document.getElementById('myDiv');
            var newInput=document.createElement('div');
            var br=document.createElement('br');
            newInput.setAttribute('class', 'division');
            newInput.setAttribute('id', 'row_'+nbrRow);
            newInput.innerHTML=`
            <label value="Reponse"${nbrRow} class="labelRep"><b>Reponse${nbrRow}</b></label>
            <input type="text" class="row" name="reponseSimple[${nbrRow}]">
            <input type="radio" name="nomradio[${nbrRow}]" class="classcheckbox">
                <button type="button" class="supprime" onClick="onDeleteinput(${nbrRow})"></button>`;
            divInputs.appendChild(newInput);
            //document.getElementById('myDiv').appendChild(br);
        }
        function onDeleteinput(n){
            var target= document.getElementById('row_'+n);
            target.remove();
        }
        function onAddinput3(){
            nbrRow++;
            var divInputs=document.getElementById('myDiv');
            var newInput=document.createElement('div');
            var br=document.createElement('br');
            newInput.setAttribute('class', 'divisiontexteArea');
            newInput.setAttribute('id', 'row');
            newInput.innerHTML=`
            <label value="Ecrivez ici" class="lab"><b>Ecrivez ici</b></label>
            <textarea type="textarea" name="area" class="rowarea" cols="5" rows="7"><?php echo @$_POST['area']; ?></textarea>`;
            divInputs.appendChild(newInput);
            //document.getElementById('myDiv').appendChild(br);
        }
        function recupere(){

        }
    </script>
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
            <form method="POST" id="issa">
                <h1 class="param">PARAMETRER VOTRE QUESTION</h1>
                <div id="cadre1">
                    <label class="quest1"><h3>Questions</h3></label>
                    <textarea name="quest" class="quest2" ><?php echo @$_POST['quest']; ?></textarea>
                    <label class="nbre1"><h3>Nbre de Points</h3></label>
                    <input type="number" name="point" class="nbre2" value="<?php echo @$_POST['point']; ?>">
                    <label class="type1"><h3>Type de reponse</h3></label>
                    <select name="type" id="type2">
                        <option>Donner le type de reponse</option>
                        <option value="multiples">multiples</option>
                        <option value="simple">simple</option>
                        <option value="texte">texte</option>
                    </select>
                    <div id="myDiv"> 
                        <div class="row" id="btn">
                            <button type="button" name="button" id="btns" ></button>
                        </div>
                    </div>
                    <input type="submit" name="valider" value="Enregistrer" class="Enregister"><br/>
                </div>
            </form>
        </div>
        <div id="menu">
            <div id="profil"><div id="border"></div><img src="<?php echo $_SESSION['avatar']; ?>" class="tof"><label class="name"><?php echo $_SESSION['prenom']."<br/>"; echo $_SESSION['nom']; ?></label></div>
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
<?php
if(isset($_POST['valider'])){
    if(!empty($_POST['quest']) AND !empty($_POST['point'])){
        if(!empty($_POST['type'])){
            if(!empty($_POST)){
                $tab=[];
                unset($_POST['valider']);
                $tab=$_POST;
                $json = file_get_contents("Question.json");
                $issa = json_decode($json, true);
                $issa[]= $tab;
                $issa=json_encode($issa);
                file_put_contents("Question.json", $issa);
            }
        }else{
            echo "<br><script>
            alert('type obligatoire!!!');
            </script>";
        }
    }else{
        echo "<br><script>
        alert('doit pas etre vide');
        </script>";
    }
}
?>
<script type="text/javascript">
    document.getElementById('btns').addEventListener('click', function(){
        if(document.getElementById('type2').value=='multiples'){
            onAddinput1();
        }else if(document.getElementById('type2').value=='simple'){
            onAddinput2();
        }else if(document.getElementById('type2').value=='texte'){
            onAddinput3();
        }
    });
</script>