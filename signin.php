<?php 
$myFile = 'user.json';
$name = $_POST["name"];
$mobile = $_POST["mobile"];
$dob = $_POST["dob"];
$department = $_POST["department"];
$college = $_POST["college"];
$email = $_POST["email"];
$pwd = $_POST["password"];
$host = 'localhost:3306';  
$user = 'admin';  
$pass = 'admin';
$dbname = "GUVI"; 
$conn = new mysqli($host, $user, $pass, $dbname);  
if(! $conn )  
{  
  die('Could not connect: ' . mysqli_error());  
}
$sql = $conn->prepare("insert into userdetail (name,email,mobile,dob,department,college,password) values (?,?,?,?,?,?,?)");
$sql->bind_param("sssssss", $name,$email,$mobile,$dob,$college,$email,$pwd);
if($sql->execute())
{ 
   $data = array(
      'name'=>$name,
      'mobile'=>$mobile,
      'department'=>$department,
      'dob'=>$dob,
      'college'=>$college,
      'email'=>$email
   );
   
   if(fopen($myFile, 'a'))
   {
      $current_data = file_get_contents($myFile);  
      $array_data = json_decode($current_data, true);  
      $array_data[] = $data;  
      $final_data = json_encode($array_data, JSON_PRETTY_PRINT);
      file_put_contents($myFile, $final_data);
   }
   $data['success'] = true;
   $user_json = json_encode($data);
     
}else{  
echo "Could not insert record: ". mysqli_error($conn);  
}  
mysqli_close($conn);
echo $user_json;
?>