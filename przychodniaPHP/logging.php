<?php
	session_start();

	require_once "connect.php";
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$login = htmlentities($login,ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo,ENT_QUOTES, "UTF-8");

		

		if($rezultat = @$polaczenie->query(sprintf("SELECT * FROM konto WHERE Login='%s' AND Hasło='%s'",mysqli_real_escape_string($polaczenie,$login),mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_uzytkownikow = $rezultat->num_rows;
			if($ilu_uzytkownikow>0)
			{
				$_SESSION['zalogowano'] = true;
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['user'] = $wiersz['Login'];
				$_SESSION['id_usera'] = $wiersz['ID'];

				$_SESSION['type'] = $wiersz['Typ'];
				
				unset($_SESSION['blad_logowania']);
				$rezultat->free_result();

				if($_SESSION['type'] == 'rejestrator')
				{
					header('Location: registrar_main.php');
				}
				
			}
			else
			{
				$_SESSION['blad_logowania'] = '<h1 class="h3 mb-3 font-weight-normal" span style="color:red">Błąd logowania, <br/>spróbuj ponownie!</h1>';
				
				header('Location: login.php');
			}
		}

		$polaczenie->close();
	}	

	
?>