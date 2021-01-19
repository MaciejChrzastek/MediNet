function cancelVisit(id){
    var x;
    var v;
    var v_val;
    var date_year = 0;
    var date_month = 0;
    var date_day = 0;
    var date_hour = 0;
    var date_min = 0;

  //  var date = new Date.UTC();
  //  date.setHours( date.getHours() + 2 );

    var date = new Date(); 
    var now_utc =  Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(),
     date.getUTCHours(), date.getUTCMinutes(), date.getUTCSeconds());
    
     var date = new Date(now_utc);

   // window.alert(date.toString());

 //  var div_els = document.getElementById("visit_list").querySelectorAll(".date_time");
  
  // var div_els = document.querySelectorAll(".visit_list .list_element .date_time");

  //      v = div_els[0].innerHTML.substring(3,18);
        var id_splitter = id.split("-");
        var id_num = id_splitter[1];
        var v = document.getElementById("date_time1-"+id_num).textContent;
        date_year = parseInt(v.substring(0,4));
        date_month = parseInt(v.substring(5,7))-1;
        date_day = parseInt(v.substring(8,10));

        date_hour = parseInt(v.substring(11,13));
        date_min = parseInt(v.substring(14,16));

        var icon_id = "icon-"+id_num;
 
        var date1 = new Date(date_year,date_month,date_day,date_hour,date_min,0,0);
        var w_id = document.getElementById("wizyta-"+id_num).textContent;
     //window.alert("aaaaaaaaaaa");

    //   window.alert("date-date: "+v+"\ndate1: "+date1+"\ndate2: "+date);
      // var txt = document.getElementById('date_time').innerHTML.substring(3,18);
    //   window.alert(icon_id);

     // window.alert(date_year+","+date_month+","+date_day+","+date_hour+","+date_minute);

    if(date1.getTime() < date.getTime()){
            x = document.getElementById("snackbar_unable");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
          //  window.location.replace("patient_visits.php?q="+w_id+"&d=0");
          return 0;

    }
    else{
        if(window.confirm("Czy na pewno chcesz odwołać wizytę?")){
        // window.alert("Wizyta została odwołana");
           x = document.getElementById("snackbar_cancelled");
           x.innerHTML="Wizyta została odwołana";
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
            var img = document.getElementById(icon_id);
            img.style.height = "25px";
            img.src = "css/cancel.png";
            x.innerHTML = "Wizyta nie została odwołana";
           // window.alert("patient_visits.php?q="+w_id+"&d=1");
           //window.location.replace("patient_visits.php?q="+w_id+"&d=1");
           return 1;

        }
        else {
        //  window.alert("Wizyta nie została odwołana");
            x = document.getElementById("snackbar_cancelled");
           // d = document.getElementById("d-"+id_num);
            x.innerHTML="Wizyta nie została odwołana";
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
           // window.alert("patient_visits.php?q="+w_id+"&d=0");
          //  window.location.href="patient_visits.php?q="+w_id+"&d=0";
            return 0;

        }
    }
 
}


function updateDB(id){    // the #id you supplied to the button, id= 'button1'

   // var value = $(id).val();  // Value of the button, value= 'button1value'
   var id_splitter = id.split("-");
   var id_num = id_splitter[1];
   var date_visit = document.getElementById("date_time1-"+id_num).textContent;
   var doctor = document.getElementById("doctor-"+id_num).textContent;
   var doctor_all = doctor.split(" ");
   var spec = doctor_all[0];
   var d_name = doctor_all[1];
   var d_surname = doctor_all[2];
  
   var str = date_visit+"&"+spec+"&"+d_name+"&"+d_surname;

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
      ;
     }
   };
   xhttp.open("POST", "patient_complaint_updateDB.php?q="+str, true);
   xhttp.send();
/*
   $.ajax({
            type: "POST",
            url: 'patient_complaint_updateDB.php',
            dataType: 'json',
          data: {date_time:date_visit,doctor_spec:spec,doctor_name:d_name,doctor_last_name:d_surname},  // the name you're assigning, think how a $_GET works in URL,  .php?name=value...
          success: function() {
            //var html = res;// no need to waste a variable, just use it directly
            console.log( "Yaaay" );        },
        error: function() {
            console.log( "Ajax Not Working" );
        }
        }); //end ajax*/
  }


function cancelVisit1(x){
  window.alert("a");
}

function submitComplaint(){
  window.alert("Reklamacja zostala złożona");
}
