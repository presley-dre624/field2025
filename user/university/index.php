<?php
include 'config.php';
session_start();

if(isset($_POST['uni'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_uni = mysqli_query($conn, "SELECT * FROM `university` WHERE email = '$email' AND password = '$pass'") or die('query failed1');

   if(mysqli_num_rows($select_uni) > 0){
      
      $row = mysqli_fetch_assoc($select_uni);
      $_SESSION['uid'] = $row['id'];
      $uid = $_SESSION['uid'];
      header('location: home/home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/style-min.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
        <h2>Sign in</h2><br>
        <span>Login to your account by providing valid credentials</span><br><br>

      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Email" class="box" required>
      <input type="password" name="password" placeholder="Password" class="box" required>
      <input type="submit" name="uni" value="Login" class="btn">
   </form>

</div>

</body>
</html>