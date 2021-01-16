<?php

function displayComplaintsList(){

    $polaczenie = mysqli_connect("localhost","root","","przychodniaDB");


    $sql = "SELECT 
                LEFT(w.`TerminWizyty`,16) AS TerminWizyty, 
                CONCAT(kp.`Imię`,' ',kp.`Nazwisko`) AS Pacjent,
                r.`Decyzja`
            FROM `reklamacja` r
                JOIN`wizyta` AS w
                    on r.`IDWizyty`=w.`ID`
                JOIN `karta pacjenta` AS kpac
                    on kpac.`ID` = w.`IDKartyPacjenta`
                LEFT JOIN `konto` AS kp
                    on kpac.`ID` = kp.`IDKartyPacjenta`
                LEFT JOIN `konto` AS kl
                    on w.`IDLekarza` = kl.`ID`
            ORDER BY w.`TerminWizyty` DESC
                ";


    $result = $polaczenie-> query($sql);
    $number=0;



    if($result -> num_rows > 0){
        while ($row = $result-> fetch_assoc()){

            if($row["Decyzja"]=="nieuznana"){
                $icon = "css/cancel.png";
                $height = "25px";
            }
            else if ($row["Decyzja"] =="uznana"){
                $icon = "css/tick.png";
                $height = "25px";
            }
            else {
                $icon = "css/watch.png";
                $height = "20px";
            }

            $termin = $row["TerminWizyty"]."";
            echo "<div id=\"div1-".$number."\" class=\"w-100 align-middle jumbotron-extra list_element\" style=\"padding-left: 25px; padding-right: 25px;height: 50px; display: flex; justify-content: space-between; flex-direction: row;\">
            <p>
            <img id=\"icon1-".$number."\" style=\"width: 20px; height:".$height.";\" src=\"". $icon ."\">
            <p id=\"date_time2-".$number."\" class=\"date_time\"><b>". $row["TerminWizyty"] ."</b></p>
            </p>
            <p id=\"doctor1-".$number."\" class=\"w-50\" style=\"text-align: center;\">". $row["Pacjent"] ."</p>
            <p id=\"options1-".$number."\"  class=\"w-25 fa-align-right\" style=\"text-align: right;\">
            <a id=\"complain1-".$number."\" onclick=\"submitComplaint()\" style=\"font-weight: bolder; margin-left: 30px;\" href=\"director_complaint_form.php\">Szczegóły</a>

            </p>
            </div>";

            $number = $number + 1; 
        }
    }
    else {
        echo '<script type="text/JavaScript">  
                document.getElementById("no_complaints").style.display = "block"; 
                </script>';
    }

}

?>