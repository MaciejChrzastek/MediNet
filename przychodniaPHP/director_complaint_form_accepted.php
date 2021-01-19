<?php
	session_start();
	if(!isset($_SESSION['zalogowano']))
	{
		header('Location: login.php');
		exit();
		
	}
	
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikacja webowa MediNet pomagająca w obsłudze wizyt w przychodni.">
    <link href="css/bootstrap1.css" rel="stylesheet">

    <script src="patient_functions.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--konieczne do działania elementow typu 'dropdown' - musi wystepowac przed ogolnym JS Bootstrapa-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--javaScript Bootstrapa-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Lista reklamacji</title>
</head>

<body>

<div id="snackbar" class = "snackbar">Reklamacja została uznana</div>
<div id="snackbar_cancelled" class = "snackbar">Reklamacja nie została uznana</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-light w-100" >
        <ul class="navbar-nav ml-auto w-100 align-left">
            <li><a href="director_main.php"><img src="css/logo.png" style="height:60px; float: left; "></a></li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto align-right">
            <li class="navbar-nav" >
               <a href="loggingout.php"> <img src="css/logout.png" style="height:30px; float: right;"> </a>
            </li>
        </ul>
    </div>
    </nav>

    <!-- drugi NavBar - menu -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto nav-fill w-100">
                <li class="nav-item active menu-item-last">
                    <a class="nav-link" href="director_complaints.php">Rozpatrz reklamacje
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!--zawartosc strony-->

    <div class="w-100" style=" display: flex; justify-content: center; margin-top: 20px; align-items: center;">
        <div class="w-75" style="flex-direction: column;">

        <p style="font-size:larger; margin-left: 20px;">
            <b style="color: var(--primary);">Szczegóły reklamacji</b>
            <hr class="my-3" >
        </p>

        <div style="margin-top: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center;">

            <form class="w-50">
                <fieldset>

                <?php 
                         $q = $_GET['q'];
                         $d = $_GET['d'];
                         include 'director_complaints_php_functions.php';
                         displayComplaintDetails($q);
                         updateRecord($q,$d);
/*
                        $polaczenie = @new mysqli("localhost","root","","przychodniaDB");
                         
                        if($polaczenie->connect_errno!=0)
                        {
                            echo "Error: ".$polaczenie->connect_errno;
                        }
                        else
                        {
                            if(isset($_GET['d'])){
                                $_SESSION['d'] = $_GET['d'];
                            }
                            if(isset($_GET['q'])){
                                $_SESSION['q'] = $_GET['q'];
                            }  
                            
                            $idDecyzji = $_SESSION['d']."";
                            $idReklamacji = $_SESSION['q']."";
                            
                            if($rezultat = @$polaczenie->query("SELECT ID from reklamacja where ID=$idReklamacji"))
                            {
                                $ile_wynikow = $rezultat->num_rows;
                                if($ile_wynikow>0)
                                {
                                    if($idDecyzji=="0"){
                                    $aktualizacja = @$polaczenie->query("UPDATE reklamacja SET reklamacja.Decyzja = 'uznana' WHERE reklamacja.ID=".$idReklamacji);
                                    }else if($idDecyzji=="1"){
                                    $aktualizacja = @$polaczenie->query("UPDATE reklamacja SET reklamacja.Decyzja = 'nieuznana' WHERE reklamacja.ID=".$idReklamacji);
                                    }
                                }
                            }
                        }
                        $polaczenie->close();

      */                 
                ?>

                </fieldset>
            </form>

            <div class="w-50" style="display: flex; flex-direction: row; margin-top: 10px; align-items: center; justify-content: space-between; ">

            <?php
            echo '
            <a type="button" onclick="acceptComplaint()" style="width:45%; text-transform: capitalize;" class="btn btn-primary"  href="director_complaint_form.php?q='.$q.'&d=1" role="button">Odrzuć</a>
            <a type="button" onclick="declineComplaint()" style="width:45%; text-transform: capitalize;" class="btn btn-primary" href="director_complaint_form.php?q='.$q.'&d=0" role="button">Akceptuj</a>
            '
            ?>

            </div>
            <div class="w-50" style="display: flex; flex-direction: row; margin-top: 10px; align-items: center; justify-content: space-between; ">
            <a type="button" style="width:100%; text-transform: none ; margin-bottom:50px;" class="btn btn-primary" href="director_complaints.php" role="button">Powrót do listy</a>
            </div>
        </div>
    </div>
    </div>


</body>

</html>