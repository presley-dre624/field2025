
<?php

include '../config/config.php';

if(isset($_POST['submit'])){

   $fname = mysqli_real_escape_string($conn, trim(strtoupper($_POST['fname'])));
   $mname = mysqli_real_escape_string($conn, trim(strtoupper($_POST['mname'])));
   $sname = mysqli_real_escape_string($conn, trim(strtoupper($_POST['sname'])));
   $email = mysqli_real_escape_string($conn, trim(strtolower($_POST['email'])));
   $gender=mysqli_real_escape_string($conn, $_POST['gender']);
   $phonenumber = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $regno = mysqli_real_escape_string($conn, trim(strtoupper($_POST['regno'])));
   $uni =mysqli_real_escape_string($conn, $_POST['uni']);
   $course =mysqli_real_escape_string($conn, $_POST['course']);
  
   
  

   $select = mysqli_query($conn, "SELECT * FROM `student` WHERE email = '$email' AND password = '$pass'") or die('query failed2');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `student`(`first_name`, `middle_name`, `surname`, `email`, `gender`, `phonenumber`, `University`, `regno`, `course`, `password`) VALUES('$fname', '$mname','$sname', '$email', '$gender', '$phonenumber', '$uni', '$regno', '$course', '$pass')") or die('query failed1');
         if ($insert){
            header('location:../');
         }else{
            $message[] = 'failed to register';
            }

         }
      }
   }



?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student registration</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../assets/css/style-min.css">

</head>
<body>
   
<div class="update-profile">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Student details</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class = "flex" style ="height: 400px;">
         <div class = "inputBox">
            <input type="text" name="fname" placeholder="First name" class="box" required>
            <input type="text" name="mname" placeholder="Middle name" class="box" required>
            <input type="text" name="sname" placeholder="Surname" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required>
            <input type="tel" name="phone" placeholder="Phone number" class="box" required>
            <select name="gender" class="box" required>
               <option selected disabled value="">Gender</option>
            <option value="MALE">Male</option>
            <option value="FEMALE">Female</option>
            </select>
         </div>
         <div class = "inputBox">
            <select name="uni" class="box" required>
               <option selected disabled value="">University</option>
            <option value="IFM-MAIN">IFM - MAIN CAMPUS</option>
            </select>
            <input type="tel" name="regno" placeholder="Registration No" class="box" required>
            <select id =""  name = "course" class="box" required>
               <option value ="" disabled selected>Course</option>
               <option value ="ACC">Accounting</option>
               <option value ="BAF">Banking and finance</option>
               <option value ="IT">Information technology</option>
               <option value ="IR">Insurerance and risk management</option>
               <option value ="SP">Social protection</option>
               <option value ="TAX">Tax management</option>
               <option value ="CS">Computer science</option>
               <option value ="ACS">Actuarial science</option>
               <option value ="BEF">Econimics and finance</option>
               <option value ="BAIT">Account with informaation technology</option>
            </select>
            <input type="password" name="password" placeholder="Password" class="box" required>
            <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
         </div>
      </div>
      
      <input type="submit" name="submit" value="Register" class="btn">
      <p>already have an account? <a href="../">Login</a></p>
   </form>

</div>

</body>
</html>