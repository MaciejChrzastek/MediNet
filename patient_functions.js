function cancelVisit(context){
    var x;
    var v;
    var v_val;
    var date_year = 0;
    var date_month = 0;
    var date_day = 0;
    var date_hour = 0;
    var date_minute = 0;

    var date = new Date();
   // window.alert(date.toString());

 //  var div_els = document.getElementById("visit_list").querySelectorAll(".date_time");
   var div_els = document.querySelectorAll(".visit_list .list_element .date_time");

     //   v = document.getElementById("date_time1").innerHTML.substring(3,18);
        v = div_els[0].innerHTML.substring(3,18);
        date_day = parseInt(v.substring(0,2));
        date_month = parseInt(v.substring(3,5));
        date_year = parseInt(v.substring(6,10));
        date_hour = parseInt(v.substring(11,13));
        date_min = parseInt(v.substring(14,16));
 
        var date1 = new Date(date_year,date_month,date_day,date_hour,date_minute,0);
     //  window.alert("a"+date1);
      // var txt = document.getElementById('date_time').innerHTML.substring(3,18);
     //  window.alert("a"+txt.toString());

     // window.alert(date_year+","+date_month+","+date_day+","+date_hour+","+date_minute);

    if(date1.getTime() < date.getTime()){
            x = document.getElementById("snackbar_unable");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    else{
        if(window.confirm("Czy na pewno chcesz odwołać wizytę?")){
        // window.alert("Wizyta została odwołana");
           x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
        else {
        //  window.alert("Wizyta nie została odwołana");
            x = document.getElementById("snackbar_cancelled");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    }
  
}

function submitComplaint(){

}