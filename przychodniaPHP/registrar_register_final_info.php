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
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--konieczne do działania elementow typu 'dropdown' - musi wystepowac przed ogolnym JS Bootstrapa-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--javaScript Bootstrapa-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>MediNet</title>
</head>

<body>

    <!-- pierwszy NavBar - ikony -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-light w-100">
        <ul class="navbar-nav ml-auto w-100 align-left">
            <li><img src="css/logo.png" style="height:60px; float: left; "></li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto align-right">
                <li class="navber-nav dropdown">
                    <a data-toggle="dropdown" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        <img src="css/user.png" style="height:30px; float: right; ">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top: 27px; border-radius: 0; width: 20em;">
                        <a class="dropdown-item" href="registrar_main.php">Aktualności</a>
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
                    <a class="nav-link" href="registrar_patient_details.php">
                        Powrót
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!--zawartosc strony-->
    <div class="w-100" style=" display: flex; justify-content: center; margin-top: 50px; align-items: center;">
        <div class="w-75" style="flex-direction: column;">

            <p style="font-size:larger; margin-left: 20px;">
                <b style="color: var(--primary);">Rejestracja Pacjenta</b>
                <hr class="my-3">
            </p>

            <?php
                        
                        require_once "connect.php";	

                               
                        if($polaczenie->connect_errno!=0)
                        {
                            echo "Error: ".$polaczenie->connect_errno;
                        }
                        else
                        {
                            if(isset($_GET['idw'])){
                                $_SESSION['idw'] = $_GET['idw'];
                            }  
                            
                            $idkartyp = $_SESSION['id_karty_wybranego_pacjenta'];
                            $idwizyty = $_SESSION['idw'];
                            
                            if($rezultat = @$polaczenie->query("SELECT wizyta.IDKartyPacjenta from wizyta where wizyta.ID=$idwizyty and wizyta.czyOdwołana=0 and wizyta.IDKartyPacjenta is null"))
                            {
                                $ile_wynikow = $rezultat->num_rows;
                                if($ile_wynikow>0)
                                {
                                    $aktualizacja = @$polaczenie->query("UPDATE wizyta SET wizyta.IDKartyPacjenta = '$idkartyp' WHERE wizyta.ID=$idwizyty and wizyta.czyOdwołana=0 and wizyta.IDKartyPacjenta is null");
                                                                                   

                                        echo'<div id="no_error" style=" display: flex; justify-content: center; margin-top: 20px;">
                                        <div class="jumbotron w-100 align-middle" style="width:1100px; height: 450px; background-color: rgba(360,360,360,0.5); ">
                        
                                            <p class="w-100 " style="text-align: center; font-size: 40px; ">Rejestracja wykonana pomyślnie</p>
                        
                                            <p id="options_no_error" class="w-100 " style="text-align: center; padding-top: 20px; ">
                                                <a id="registrarContinueButton" style="font-weight: bolder; font-size: 40px; " href="registrar_patient_details.php">Dalej</a>
                                            </p>
                                        </div>
                                    </div>';
                           
                                    
                                }
                                else
                                {
                                    echo'<div id="error" style=" display: flex; justify-content: center; margin-top: 20px;">
                                    <div class="jumbotron w-100 align-middle" style="width:1100px; height: 450px; background-color: rgba(360,360,360,0.5); ">
                    
                                        <p class="w-100 " style="text-align: center; font-size: 40px; ">Wystąpił nieoczekiwany błąd - spróbuj ponownie później</p>
                    
                                        <p id="options_error" class="w-100 " style="text-align: center; padding-top: 20px; ">
                                        <a id="registrarCancelAcceptPaymentButton" style="font-weight: bolder; font-size: 40px; " href="registrar_patient_details.php">Rozumiem</a>
                                    </p>
                                    </div>
                                </div>';
                                }
                            }
                
                            $polaczenie->close();
                        }	
                        
                    ?>

            

            

        </div>
    </div>



</body>

</html>