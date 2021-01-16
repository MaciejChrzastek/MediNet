<?php

function displayListItems(){

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
        <p>
        <img id=\"icon-".$number."\" style=\"width: 20px; height:".$height.";\" src=\"". $icon ."\">
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

}

?>