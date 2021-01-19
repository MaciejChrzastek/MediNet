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

    <title>Moje wizyty</title>
</head>

<body>

    <div id="snackbar" class = "snackbar">Wizyta została odwołana</div>
    <div id="snackbar_cancelled" class = "snackbar">Wizyta nie została odwołana</div>
    <div id="snackbar_unable">Brak możliwości odwołania odbytej wizyty</div>
 <!--   <div id="snackbar_complain">Reklamacja została złożona</div> -->


    <!-- pierwszy NavBar - ikony + dropdown -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-light w-100" >
        <ul class="navbar-nav ml-auto w-100 align-left">
            <li><a href="patient_main.php"><image src="css/logo.png" style="height:60px; float: left; "></a></li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto align-right">
            <li class="navber-nav dropdown" >
                <a data-toggle="dropdown"  id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                    <img src="css/user.png" style="height:30px; float: right; ">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top: 27px; border-radius: 0; width: 20em;">
                    <a class="dropdown-item" href="#">Moja karta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Umów się na wizytę</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="loggingout.php">Wyloguj</a>
                  </div>
            </li>
        </ul>
    </div>
    </nav>

    <!-- drugi NavBar - menu -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto nav-fill w-100">
                <li class="nav-item active menu-item">
                    <a class="nav-link" href="patient_visits.php">Wizyty
                <span class="sr-only">(current)</span>
              </a>
                </li>
                <li class="nav-item active menu-item" >
                    <a class="nav-link" href="#">Historia płatności</a>
                </li>
                <li class="nav-item active menu-item">
                    <a class="nav-link" href="#">Recepty</a>
                </li>
                <li class="nav-item active menu-item">
                    <a class="nav-link" href="#">Zwolnienia</a>
                </li>
                <li class="nav-item active menu-item-last">
                    <a class="nav-link" href="#">Skierowania</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--zawartosc strony-->

    <div class="w-100" style=" display: flex; justify-content: center; margin-top: 50px; align-items: center;">
        <div class="w-75" style="flex-direction: column;">

        <p style="font-size:larger; margin-left: 20px;">
            <b style="color: var(--primary);">Twoje wizyty</b>
            <hr class="my-3" >
        </p>

        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">

        <div id="no_visits" class=" w-85 align-middle " style="display:none; height: 200px; margin-top: 20px; justify-content: center; align-items: center; padding: 50px; text-align: center;" >
            <h5 style="color: var(--primary);">Nie masz jeszcze zapisanych wizyt</h5>
            <a class="btn btn-primary" style="margin-top: 50px;" href="patient_main.php" role="button">Powrót</a>
        </div>

        <div id="visit_list" class="w-85 align-middle visit_list" style="margin-top: 20px; justify-content: center; align-items: center;" >
         <!--<div class="w-100 align-middle jumbotron-extra list_element" style="padding-left: 25px; padding-right: 25px;height: 50px; display: flex; justify-content: space-between; flex-direction: row;">
                <p id="ic_and_date w-25">
                <img id="icon" style="width: 20px; height:25px;" src="css/tick.png">
                <p id="date_time" class="date_time"><b>01.01.2020 12:00</b></p>
                </p>
                <p id="doctor" class="w-50" style="text-align: center;">dr Alicja Królik</p>
                <p id="options"  class="w-25 fa-align-right" style="text-align: right;">
                <a id="cancel" onclick="cancelVisit(this)" style="font-weight: bolder;" href="#">Odwołaj</a>
                <a id="complain" onclick="submitComplaint()" style="font-weight: bolder; margin-left: 30px;" href="patient_complaint_form.php">Zareklamuj</a>
                </p>
            </div>
            <div class="w-100 align-middle jumbotron-extra list_element" style="padding-left: 25px; padding-right: 25px;height: 50px; display: flex; justify-content: space-between; flex-direction: row;">
                <p id="ic_and_date w-25">
                <img id="icon" style="width: 20px; height:25px;" src="css/tick.png">
                <p id="date_time1" class="date_time"><b>01.01.2022 12:00</b></p>
                </p>
                <p id="doctor" class="w-50" style="text-align: center;">dr Alicja Królik</p>
                <p id="options"  class="w-25 fa-align-right" style="text-align: right;">
                <a id="cancel" onclick="javascript:cancelVisit1()" style="font-weight: bolder;" href="#">Odwołaj</a>
                <a id="complain" onclick="submitComplaint()" style="font-weight: bolder; margin-left: 30px;" href="patient_complaint_form.php">Zareklamuj</a>
                </p>
            </div> -->
            <?php

                include 'patient_visits_php_functions.php';
               if ((((array_key_exists('q',$_GET)) || (!empty($_GET['q']))))&&((((($_GET['d'])=="1"))))){
                    $q = $_GET['q'];
                    updateRecord($q);
                 }
              
              displayListItems(); 
                 if (array_key_exists('powrot',$_GET) || !empty($_GET['powrot'])){
                    echo" <script type='text/JavaScript'>
                    x = document.getElementById(\"snackbar_cancelled\");
                    x.innerHTML=\"Reklamacja została złożona\";
                    x.className = \"show\";
                    setTimeout(function(){ x.className = x.className.replace(\"show\", \"\"); }, 2000);
                                        </script> ";}


            /*
	            $polaczenie = mysqli_connect("localhost","root","","przychodniaDB");
                $sql = "SELECT 
                            LEFT(w.`TerminWizyty`,16) AS TerminWizyty, 
                            CONCAT(kl.`Stopień`,' ',kl.`Imię`,' ',kl.`Nazwisko`) AS Lekarz,
                            w.`czyOdwołana`
                        FROM `wizyta` AS w
                            JOIN `karta pacjenta` AS kpac
                                on kpac.`ID` = w.`IDKartyPacjenta`
                            LEFT JOIN `konto` AS kp
                                on kpac.`ID` = kp.`IDKartyPacjenta`
                            LEFT JOIN `konto` AS kl
                                on w.`IDLekarza` = kl.`ID`
                        WHERE kp.`ID` = ".$_SESSION['id_usera']."
                        ORDER BY w.`TerminWizyty` DESC
                            ";
                $result = $polaczenie-> query($sql);
                $number=0;

                if($result -> num_rows > 0){
                    while ($row = $result-> fetch_assoc()){

                        if($row["czyOdwołana"]==1){
                            $icon = "css/cancel.png";
                            $height = "25px";
                        }
                        else if ($row["TerminWizyty"] < date("Y-m-d H:i")){
                            $icon = "css/tick.png";
                            $height = "25px";
                        }
                        else {
                            $icon = "css/watch.png";
                            $height = "20px";
                        }

                        $termin = $row["TerminWizyty"]."";
                        echo "<div id=\"div--".$number."\" class=\"w-100 align-middle jumbotron-extra list_element\" style=\"padding-left: 25px; padding-right: 25px;height: 50px; display: flex; justify-content: space-between; flex-direction: row;\">
                        <p id=\"ic_and_date w-25\">
                        <img id=\"icon\" style=\"width: 20px; height:".$height.";\" src=\"". $icon ."\">
                        <p id=\"date_time1-".$number."\" class=\"date_time\"><b>". $row["TerminWizyty"] ."</b></p>
                        </p>
                        <p id=\"doctor-".$number."\" class=\"w-50\" style=\"text-align: center;\">". $row["Lekarz"] ."</p>
                        <p id=\"options-".$number."\"  class=\"w-25 fa-align-right\" style=\"text-align: right;\">
                        <a id=\"cancel-".$number."\" onclick=\"cancelVisit(this.id)\" style=\"font-weight: bolder;\" href=\"#\">Odwołaj</a>
                        <a id=\"complain-".$number."\" onclick=\"submitComplaint()\" style=\"font-weight: bolder; margin-left: 30px;\" href=\"patient_complaint_form.php\">Zareklamuj</a>

                        </p>
                        </div>";

                        $number = $number + 1; 
                    }
                }
                else {
                    echo '<script type="text/JavaScript">  
                            document.getElementById("no_visits").style.display = "block"; 
                             </script>';
                }
*/
            ?>
        </div>
       </div>
    </div>
    </div>
</body>

</html>