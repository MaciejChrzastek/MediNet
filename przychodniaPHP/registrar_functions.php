<?php

    public function getPatients(){
        require_once "connect.php";
	
	
        if($polaczenie->connect_errno!=0)
        {
            echo "Error: ".$polaczenie->connect_errno;
        }
        else
        {
            
            if($rezultat = @$polaczenie->query("SELECT * FROM konto WHERE Typ='pacjent'"))
            {
                $ile_wynikow = $rezultat->num_rows;
                if($ile_wynikow>0)
                {
                    $lista_pacjentow = array();

                    while($wiersz = $rezultat->fetch_assoc()){
                        $lista_pacjentow[]=$wiersz;
                    }

                    return $lista_pacjentow;
                    
                }
                else
                {
                    return false;
                }
            }

            $polaczenie->close();
        }	

    }

	

	
?>