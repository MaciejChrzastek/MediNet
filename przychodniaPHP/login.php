<?php
    session_start();

	if((isset($_SESSION['zalogowano'])) && ($_SESSION['zalogowano']==true))
	{
		if($_SESSION['type'] == 'rejestrator')
		{
			header('Location: registrar_main.php');
			exit();
        }
        else if($_SESSION['type'] == 'pacjent')
		{
			header('Location: patient_main.php');
			exit();
        }
        else if($_SESSION['type'] == 'dyrektor')
		{
			header('Location: director_main.php');
			exit();
        }
        
	}
	
?>
<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" action="logging.php" method="post">
        <img class="mb-4" src="css/icon.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Zaloguj się</h1>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="haslo" placeholder="Hasło" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>

	<?php
		if(isset($_SESSION['blad_logowania']))
		echo $_SESSION['blad_logowania'];

	?>
    </form>

	
</body>

</html>