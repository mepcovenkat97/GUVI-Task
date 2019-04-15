<?php
   session_start();
   $email = $_SESSION["email"];
   
   $string = file_get_contents("user.json");
   $jsonRS = json_decode ($string,true);
   foreach ($jsonRS as $rs) 
   {
      if($rs["email"]===$email)
      {
         $data = array(
            'wname'=>$rs["name"],
            'name'=>$rs["name"],
            'mobile'=>$rs["mobile"],
            'department'=>$rs["department"],
            'dob'=>$rs["dob"],
            'college'=>$rs["college"],
            'email'=>$rs["email"]
         );
         $user_data = json_encode($data);
         break;
      }
   }
   echo $user_data;

?>  