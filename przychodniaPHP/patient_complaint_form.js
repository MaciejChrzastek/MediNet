function submitComplaint(){
    //window.alert("Reklamacja została złożona");
    x = document.getElementById("snackbar");
    x.className = "show";
    window.setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  //  window.location.replace("patient_visits.php");

}