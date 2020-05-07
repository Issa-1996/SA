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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
    <div id="hautp"><img src="images/logo-QuizzSA.png" class="logo"><label class="plaisir">Le plaisir de jouer</label></div>
    <div id="imgbac"> </div>
    <div id="bar">
        <h1  class="message">Tableau de bord</h1>
        <a href="DeconnexionInterAdmin.php"><input type="submit" name="deconnexion" value="Deconnexion" class="decon"></a>
    </div>
    <div id="form">
        <div class="chartjs">
        <canvas id="myChart" width="100%" height="60%">
        
        </canvas>
        </div>
        <div id="menu">
           <div id="profil"><div id="border"></div><a href="#"><img src="<?php echo $_SESSION['avatar']; ?>" class="tof"></a><label class="name"><?php echo $_SESSION['prenom']."<br/>"; echo $_SESSION['nom']; ?></label></div>
           <div id="pages">
               <a href="AccueilAdmin.php" class="liste0">Tableau bord <img src="images/icones/ic-liste.png" class="icone0"></a>
               <a href="ListeQuestion.php" class="liste1">Liste question <img src="images/icones/ic-liste.png" class="icone1"></a>
               <a href="CreerAdmin.php" class="liste2">Créer Admin <img src="images/icones/ic-ajout.png" class="icone2"></a>
               <a href="ListeJoueur.php" class="liste3">Liste joueurs <img src="images/icones/ic-liste.png" class="icone3"></a>
               <a href="InterfaceAdmiQuestion.php" class="liste4">Créer Questions <img src="images/icones/ic-ajout.png" class="icone4"></a>
            </div>
        </div>
   </div>
</body>
</html>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart= new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Issa', 'Aziz', 'Aby', 'Cheikh', 'Yacine', 'Diamanka' ],
            datasets: [{
                label: '# Scores',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes:[{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>