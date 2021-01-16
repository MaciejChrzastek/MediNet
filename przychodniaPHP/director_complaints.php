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

    <div class="w-100" style=" display: flex; justify-content: center; margin-top: 50px; align-items: center;">
        <div class="w-75" style="flex-direction: column;">

        <p style="font-size:larger; margin-left: 20px;">
            <b style="color: var(--primary);">Reklamacje</b>
            <hr class="my-3" >
        </p>

        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">

        <div id="no_complaints" class=" w-85 align-middle " style="display:none; height: 200px; margin-top: 20px; justify-content: center; align-items: center; padding: 50px; text-align: center;" >
            <h5 style="color: var(--primary);">Lista jest pusta</h5>
        </div>

        <div id="complaint_list" class="w-85 align-middle visit_list" style="margin-top: 20px; justify-content: center; align-items: center;" >
            <?php
                include 'director_complaints_php_functions.php';
                displayComplaintsList(); 
            ?>
        </div>
       </div>
    </div>
    </div>
</body>

</html>