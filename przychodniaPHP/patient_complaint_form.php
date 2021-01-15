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
    
    <script src="patient_complaint_form.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--konieczne do działania elementow typu 'dropdown' - musi wystepowac przed ogolnym JS Bootstrapa-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--javaScript Bootstrapa-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Reklamacja</title>
</head>

<body>

    <div id="snackbar" class = "snackbar">Reklamacja została złożona</div>
  
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
            <b style="color: var(--primary);">Formularz reklamacyjny</b>
            <hr class="my-3" >
        </p>

        <div style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; justify-content: center;">

            <form class="w-50">
                <fieldset>
                  <div class="form-group ">
                    <label for="reason"  style="color: var(--primary);"><b>Powód reklamacji</b></label>
                    <div >
                        <textarea class="form-control" id="reason" rows="4" placeholder="Powód reklamacji..."></textarea>                    
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="amount" style="color: var(--primary);"><b>Kwota reklamacji</b></label>
                    <div >
                      <input type="text"  class="form-control" id="amount" placeholder="50,00">
                    </div>
                  </div>
                </fieldset>
            </form>

            <div class="w-50" style="display: flex; flex-direction: row; margin-top: 10px; align-items: center; justify-content: space-between; ">

            <a type="button" style="width:150px; text-transform: capitalize;" class="btn btn-primary"  href="patient_visits.php" role="button">Anuluj</a>
            <a type="button" onclick="submitComplaint()" style="width:150px; text-transform: capitalize;" class="btn btn-primary" href="patient_visits.php" role="button">Reklamuj</a>

            </div>

        </div>
    </div>
    </div>
</body>

</html>