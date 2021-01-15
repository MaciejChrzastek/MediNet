<?php

    $date = $_POST['date_time'];   
    $doctor_specialization = $_POST['doctor_spec']; 
    $doctor_name = $_POST['doctor_name']; 
    $doctor_last_name = $_POST['doctor_surname']; 

    $polaczenie = mysqli_connect("localhost","root","","przychodniaDB");

                $sql = "
                UPDATE `wizyta` 
                SET `czyOdwołana`=1 
                WHERE `ID` IN (
                        SELECT 
                            w.`ID`
                        FROM `wizyta` AS w
                            JOIN `karta pacjenta` AS kpac
                                on kpac.`ID` = w.`IDKartyPacjenta`
                            LEFT JOIN `konto` AS kp
                                on kpac.`ID` = kp.`IDKartyPacjenta`
                            LEFT JOIN `konto` AS kl
                                on w.`IDLekarza` = kl.`ID`
                        WHERE kp.`ID` = ".$_SESSION['id_usera']."
                            AND kl.`Imię` = ".$doctor_name."
                            AND kl.`Nazwisko` = ".$doctor_last_name."
                            AND kl.`Stopień` = ".$doctor_specialization."
                            AND w.`TerminWizyty` = ".$date."
                )";
                $result = $polaczenie-> query($sql);


?>