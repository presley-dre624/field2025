
<?php
include 'config/config.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `student` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home/');
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
   <title>Field management system</title>

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
      <input type="submit" name="submit" value="Login" class="btn">
      <p>don't have an account? <a href="register">Register</a></p>
   </form>

</div>

</body>
</html>