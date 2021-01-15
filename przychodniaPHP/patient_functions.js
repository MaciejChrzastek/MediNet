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
 
        var date1 = new Date(date_year,date_month,date_day,date_hour,date_min,0,0);
    //   window.alert("date-date: "+v+"\ndate1: "+date1+"\ndate2: "+date);
      // var txt = document.getElementById('date_time').innerHTML.substring(3,18);
     //  window.alert("a"+txt.toString());

     // window.alert(date_year+","+date_month+","+date_day+","+date_hour+","+date_minute);

    if(date1.getTime() < date.getTime()){
            x = document.getElementById("snackbar_unable");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    }
    else{
        if(window.confirm("Czy na pewno chcesz odwołać wizytę?")){
        // window.alert("Wizyta została odwołana");
           x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
        }
        else {
        //  window.alert("Wizyta nie została odwołana");
            x = document.getElementById("snackbar_cancelled");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
            updateDB(id);
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

      $.ajax({
          url: 'patient_complaint_updateDB.php', // The php page with the functions
          type: 'POST',
          data: {date_time:date_visit,doctor_spec:spec,doctor_name:d_name,doctor_last_name:d_surname},  // the name you're assigning, think how a $_GET works in URL,  .php?name=value...
      }); //end ajax
  }


function cancelVisit1(){
  window.alert("a");
}

function submitComplaint(){
}