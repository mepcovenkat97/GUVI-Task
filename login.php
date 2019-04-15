<?php
/*$email = $_GET["email"];
$pwd = $_GET["password"];
$host = 'localhost:3306';  
$user = 'admin';  
$pass = 'admin';
$dbname = "GUVI"; 
$conn = new mysqli($host, $user, $pass, $dbname);  
if(! $conn )  
{  
  die('Could not connect: ' . mysqli_error());  
}
$stmt = $conn->prepare("SELECT * FROM Userdetails WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_assoc()) 
{
   if($row['email'] === $email && $row['password']===$pwd)
   {
      session_start();
         $_SESSION["email"]=$email;
         header('Location: userdata.html');
   }
}
$stmt->close();
mysqli_close($conn);*/
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array

    if (empty($_POST['email']))
        $errors['email'] = 'Email is required.';

    if (empty($_POST['password']))
        $errors['password'] = 'Password is required.';

// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

      $email = $_POST['email'];
      $pwd = $_POST['password'];
      $host = 'localhost:3306';  
      $user = 'admin';  
      $pass = 'admin';
      $dbname = "GUVI"; 
      $conn = new mysqli($host, $user, $pass, $dbname);  
      if(! $conn )  
      {  
        die('Could not connect: ' . mysqli_error());  
      }
      $stmt = $conn->prepare("SELECT * FROM userdetail WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows === 0)
      {
         exit;
      }
      else{
      while($row = $result->fetch_assoc()) 
      {
         if($row['email'] === $email && $row['password']===$pwd)
         {
               session_start();
               $_SESSION["email"]=$email;
               $data = array(
                  'name'=>$row['name'],
                  'mobile'=>$row['mobile'],
                  'department'=>$row['department'],
                  'dob'=>$row['dob'],
                  'college'=>$row['college'],
                  'email'=>$row['email']
               );
               $data['success'] = true;
               $data['message'] = 'Success';
         }
      }
   }
        $stmt->close();
        mysqli_close($conn);
        
    }

    // return all our data to an AJAX call
    echo json_encode($data);

?>