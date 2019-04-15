var xmlhttp;

function caller(){
   xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange=getInfo;
   xmlhttp.open("GET", "load-text.php",true); 
   xmlhttp.send();
   }

function getInfo()
{
   if(xmlhttp.readyState==4){  
      console.log(xmlhttp.responseText);
      var val=JSON.parse(xmlhttp.responseText);
      document.getElementById("wname").innerText=val.wname;  
      document.getElementById("name").innerText=val.name;
      document.getElementById("mobile").innerText=val.mobile;
      document.getElementById("dept").innerText=val.department;
      document.getElementById("email").innerText=val.email;
      document.getElementById("dob").innerText=val.dob;
      document.getElementById("college").innerText=val.college;
      }  
}