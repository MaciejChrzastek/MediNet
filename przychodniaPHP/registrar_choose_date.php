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


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
                <b style="color: var(--primary);">Wybieranie Terminu Wizyty</b>
                <hr class="my-3">
            </p>

            <div style=" display: flex; justify-content: center; margin-top: 30px; align-items: center; align-content: center;">
                <div class="jumbotron w-100 align-middle" style="width:1100px; height: 250px; background-color: rgba(360,360,360,0.5); ">

                    <form action="registrar_date_final_info.php" method="post">
                        <input id="datepicker" name="wybranadata" type="date" width="1140" style="text-align: center; font-size: 30px; " />
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>
                        <p id="options1" class="w-100 " style="text-align: center; padding-top: 40px; ">
                            <input type="submit" value="Wybierz" id="registrarChooseDateButton" style="font-weight: bolder; font-size: 30px;" />
                        </p>
                    </form>                    

                </div>
            </div>

        </div>
    </div>



</body>

</html>