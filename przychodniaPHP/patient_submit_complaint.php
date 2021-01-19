<?php 

function addComplaint($id,$reason,$amount){


    $polaczenie = @new mysqli("localhost","root","","przychodniaDB");

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    else
    {
        
       // if(!empty($_GET['id']) && !empty($_GET['reason']) && !empty($_GET['amount'])){
       /*     $_SESSION['id'] = $_GET['id'];
            $_SESSION['reason'] = $_GET['reason'];
            $_SESSION['amount'] = $_GET['amount'];
        
        */

        $idWizyty = intval($id);//$_SESSION['id']);
        $reason = $reason;//$_SESSION['reason']."";
        $amount = doubleval($amount);//$_SESSION['amount']);
        
        if($rezultat = @$polaczenie->query("SELECT ID from wizyta where ID=$idWizyty"))
        {
            $ile_wynikow = $rezultat->num_rows;
            if($ile_wynikow>0)
            {
               // echo "\n".$idWizyty.", ".$reason.", ".$amount;
                $aktualizacja = @$polaczenie->query("INSERT INTO reklamacja (`DataZłożenia`,`IDWizyty`,`Opis`,`Kwota`) VALUES (CURRENT_TIMESTAMP(),$idWizyty,'$reason',$amount)");
            }
        }
    //}
    }
    $polaczenie->close();
   
}

?>