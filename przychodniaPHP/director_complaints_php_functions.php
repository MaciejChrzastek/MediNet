<?php

function displayComplaintsList(){

    $polaczenie = mysqli_connect("localhost","root","","przychodniaDB");


    $sql = "SELECT 
                r.`ID`,
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
            <p id=\"complaint-".$number."\" style=\"display:none; text-align: center;\">". $row["ID"] ."</p>
            <p>
            <img id=\"icon1-".$number."\" style=\"width: 20px; height:".$height.";\" src=\"". $icon ."\">
            <p id=\"date_time2-".$number."\" class=\"date_time\"><b>". $row["TerminWizyty"] ."</b></p>
            </p>
            <p id=\"doctor1-".$number."\" class=\"w-50\" style=\"text-align: center;\">". $row["Pacjent"] ."</p>
            <p id=\"options1-".$number."\"  class=\"w-25 fa-align-right\" style=\"text-align: right;\">
            <a id=\"complain1-".$number."\" onclick=\"complaintDetails(this.id)\" style=\"font-weight: bolder; margin-left: 30px;\" href=\"#\">Szczegóły</a>

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

function displayComplaintDetails($id){

    $polaczenie = mysqli_connect("localhost","root","","przychodniaDB");


    $sql = "SELECT 
                r.`ID`,
                LEFT(r.`DataZłożenia`,16) AS DataZłożenia,
                LEFT(w.`TerminWizyty`,16) AS TerminWizyty,
                IFNULL(r.`Kwota`,0.00) as Kwota,
                CONCAT(kl.`Stopień`,' ',kl.`Imię`,' ',kl.`Nazwisko`) AS Lekarz,
                CONCAT(kp.`Imię`,' ',kp.`Nazwisko`) AS Pacjent,
                r.`Opis`,
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
            WHERE r.`ID`=".$id."
            ORDER BY w.`TerminWizyty` DESC
                ";


    $result = $polaczenie-> query($sql);
    $row = $result-> fetch_assoc();

    echo'
    <div class="form-group row">
    <label for="patient" class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Składający</b></label>
        <div class="col-sm-9">
         <input type="text" readonly="" class="form-control" style = "background-color: #ffffff;" id="patient" value="'.$row["Pacjent"].'">
        </div> 
    </div>
    <div class="form-group row">
        <label for="date_sub" class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Data złożenia</b></label>
        <div class="col-sm-9">
            <input type="text" readonly="" class="form-control" style = "background-color: #ffffff;" id="date_sub" value="'.$row["DataZłożenia"].'">
        </div>
    </div>
    <div class="form-group row">
        <label for="date_visit" class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Data wizyty</b></label>
        <div class="col-sm-9">
            <input type="text" readonly="" class="form-control" style = "background-color: #ffffff;" id="date_visit" value="'.$row["TerminWizyty"].'">
        </div>
    </div>
    <div class="form-group row">
        <label for="sum" class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Kwota</b></label>
        <div class="col-sm-9">
            <input type="text" readonly="" class="form-control" style = "background-color: #ffffff;" id="sum" value="'.$row["Kwota"].' zł">
        </div>
    </div>
    <div class="form-group row">
        <label for="doctor" class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Lekarz</b></label>
        <div class="col-sm-9">
            <input type="text" readonly="" class="form-control" style = "background-color: #ffffff;" id="doctor" value="'.$row["Lekarz"].'">
        </div>
    </div>
    <div class="form-group row">
        <label for="reason"  class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Powód</b></label>
        <div class="col-sm-9">
            <textarea class="form-control" readonly="" style = "background-color: #ffffff;" id="reason" rows="4">'.$row["Opis"].'</textarea>                    
        </div>
    </div>
    <div class="form-group row">
        <label for="justification"  class="col-sm-3 col-form-label" style="color: var(--primary);"><b>Uzasadnienie</b></label>
        <div class="col-sm-9">
            <textarea class="form-control" style = "background-color: #ffffff;" id="justification" rows="2"></textarea>                    
        </div>
    </div>
    ';
}

?>