<?php
include '../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


session_start();
$id = $_SESSION['oid'];

if (!isset($_SESSION['oid'])){
    header('location: ../');
}


  //a function that send mail to supervisor
  function sendMail($email, $pswd){

    $name = "Field Management System";
    $to = $email;
    $subject = "Supervisor Login credentials";
    $body = "Your password is: $pswd , use it with your email address to access your supervisor account.";
    $from = "livenba0018@gmail.com";
    $password ="wckowklesscxpzlh";

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPmailer();

    $mail->isSMTP();
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; for debbugin
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //$mail->SMTPSecure = "tls";
    //$mail->smtpConnect([
      // 'ssl' => [
        //  'verify_peer' => false,
          //'verify_peer_name' => false,
          //'allow_self_signed' => true
       //]
       //]);

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to);
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()){
       return true;
    } else {
       return false;
       //echo $mail->ErrorInfo; for debbugin
    }
 }







if (isset($_POST['submit-pos'])){
  $course[]="";
  $pos[]="";
  $names[]="";
  $emails[]="";
  //$message_pos[] = "";




 
  if (isset($_POST['acc'])){
    $acc = $_POST['acc'];
    array_push($course, $acc);
    if (!isset($_POST['acc_pos'])){
      $message_pos[] = "Number of students for Accounting is required";
    }else{
      $acc_pos = $_POST['acc_pos'];
      array_push($pos, $acc_pos);
  }
  if (empty($_POST['sname_acc']) || empty($_POST['semail_acc'])){
    $message_supervisor[] = "Supervisor name or email for accouting is required";
  }else{
    $name = trim(strtoupper($_POST['sname_acc']));
    array_push($names, $name);
    $email = trim(strtolower($_POST['semail_acc']));
    array_push($emails, $email);
  }
}
  
  if (isset($_POST['bf'])){
    $bf = $_POST['bf'];
    array_push($course, $bf);
    if (!isset( $_POST['bf_pos'])){
      $message_pos[] = "Number of students for Banking and finance is required";
    }else{
    $bf_pos = $_POST['bf_pos'];
    array_push($pos, $bf_pos);
  }
  if (!isset($_POST['sname_bf']) || !isset($_POST['semail_bf'])){
    $message_supervisor[] = "Supervisor name or email for banking and finance is required";
  }else{
    $name = trim(strtoupper($_POST['sname_bf']));
    array_push($names, $name);
    $email = trim(strtolower($_POST['semail_bf']));
    array_push($emails, $email);
  }
}
  

  if (isset($_POST['it'])){
    $it = $_POST['it'];
    array_push($course, $it);
    if (!isset($_POST['it_pos'])){
      $message_pos[] = "Number of students for Information Technology is required";
    }else{
      $it_pos = $_POST['it_pos'];
      array_push($pos, $it_pos);
    }
    if (!isset($_POST['sname_it']) || !isset($_POST['semail_it'])){
      $message_supervisor[] = "Supervisor name or email for Information technology is required";
    }else{
      $name = trim(strtoupper($_POST['sname_it']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_it']));
      array_push($emails, $email);
    }
  }
  
  if (isset($_POST['cs'])){
    $cs = $_POST['cs'];
    array_push($course, $cs);
    if (!isset($_POST['cs_pos'])){
      $message_pos[] = "Number of students for Computer science is required";
    }else{
      $cs_pos = $_POST['cs_pos'];
      array_push($pos, $cs_pos);
    }

    if (!isset($_POST['sname_cs']) || !isset($_POST['semail_cs'])){
      $message_supervisor[] = "Supervisor name or email for Computer Science is required";
    }else{
      $name = trim(strtoupper($_POST['sname_cs']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_cs']));
      array_push($emails, $email);
    }
  }

  
  if (isset($_POST['sp'])){
    $sp = $_POST['sp'];
    array_push($course, $sp);
    if (!isset($_POST['sp_pos'])){
      $message_pos[] = "Number of students for social protection is required";
    }else{
      $sp_pos = $_POST['sp_pos'];
      array_push($pos, $sp_pos);
    }

    if (!isset($_POST['sname_sp']) || !isset($_POST['semail_sp'])){
      $message_supervisor[] = "Supervisor name or email for Social protection is required";
    }else{
      $name = trim(strtoupper($_POST['sname_sp']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_sp']));
      array_push($emails, $email);
    }
  }

  
  if (isset($_POST['tx'])){
    $tx = $_POST['tx'];
    array_push($course, $tx);
    if (!isset($_POST['tx_pos'])){
      $message_pos[] = "Number of students for Taxation is required";
    }else{
      $tx_pos = $_POST['tx_pos'];
      array_push($pos, $tx_pos);
    }
    if (!isset($_POST['sname_tx']) || !isset($_POST['semail_tx'])){
      $message_supervisor[] = "Supervisor name or email for Taxation is required";
    }else{
      $name = trim(strtoupper($_POST['sname_tx']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_tx']));
      array_push($emails, $email);
    }
  }

  
  if (isset($_POST['bait'])){
    $bait = $_POST['bait'];
    array_push($course, $bait);
    if (!isset($_POST['bait_pos'])){
      $message_pos[] = "Number of students for Account with IT is required";
    }else{
      $bait_pos = $_POST['bait_pos'];
      array_push($pos, $bait_pos);
    }
    if (!isset($_POST['sname_bait']) || !isset($_POST['semail_bait'])){
      $message_supervisor[] = "Supervisor name or email for Accounting with IT is required";
    }else{
      $name = trim(strtoupper($_POST['sname_bait']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_bait']));
      array_push($emails, $email);
    }
  }

 
  if (isset($_POST['bef'])){
    $bef = $_POST['bef'];
    array_push($course, $bef);
    if (!isset($_POST['bef_pos'])){
      $message_pos[] = "Number of students for Economic and Finance is required";
    }else{
      $bef_pos = $_POST['bef_pos'];
      array_push($pos, $bef_pos);
    }
    if (!isset($_POST['sname_bef']) || !isset($_POST['semail_bef'])){
      $message_supervisor[] = "Supervisor name or email for Economic and Finance is required";
    }else{
      $name = trim(strtoupper($_POST['sname_bef']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_bef']));
      array_push($emails, $email);
    }
  }

  
  if (isset($_POST['ir'])){
    $ir = $_POST['ir'];
    array_push($course, $ir);
    if (!isset($_POST['ir_pos'])){
      $message_pos[] = "Number of students for Insurance and risk management is required";
    }else{
      $ir_pos = $_POST['ir_pos'];
      array_push($pos, $ir_pos);
    }
    if (!isset($_POST['sname_ir']) || !isset($_POST['semail_ir'])){
      $message_supervisor[] = "Supervisor name or email for Insurance is required";
    }else{
      $name = trim(strtoupper($_POST['sname_ir']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_ir']));
      array_push($emails, $email);
    }
  }

  
  if (isset($_POST['acs'])){
    $acs = $_POST['acs'];
    array_push($course, $acs);
    if (!isset($_POST['acs_pos'])){
      $message_pos[] = "Number of students for Actuarial science is required";
    }else{
      $acs_pos = $_POST['acs_pos'];
      array_push($pos, $acs_pos);
    }
    if (!isset($_POST['sname_acs']) || !isset($_POST['semail_acs'])){
      $message_supervisor[] = "Supervisor name or email for Actuarial science is required";
    }else{
      $name = trim(strtoupper($_POST['sname_acs']));
      array_push($names, $name);
      $email = trim(strtolower($_POST['semail_acs']));
      array_push($emails, $email);
    }
  }

 $i = count($course);
 $x = count($pos);
 //$y = count($message_pos);
 $_SESSION['c'] = $x;
 //$_SESSION['e'] = $y;
if ($i <= 1 || $x <= 1){
  $message[] = "Please provide atleast one of these informations!";
} else{
  if(!isset($message_pos) || !isset($message_supervisor)){
    for ($j = 1; $j < $i; $j++){
      $crs = $course[$j];
      $ps = $pos[$j];
      $name = $names[$j];
      $mail = $emails[$j];
      $pass = rand(100000,999999);

      $sendM = sendMail($mail,$pass);

     
      if ($sendM){

      $enc_pass = md5($pass);
      $insert = mysqli_query($conn, "INSERT INTO `organization_pos`(organization_id, course, required_pos) VALUES('$id', '$crs', '$ps')") or die('query failed');

      $insert_pos = mysqli_query($conn, "INSERT INTO `organization_ocupied_pos`(oid, course, pos) values ('$id', '$crs', 0)") or die('query failed');

      $insert_super = mysqli_query($conn,"INSERT INTO `supervisors`(`organization`, `supervisor_name`, `email`, `course`, `password`) values('$id', '$name', '$mail', '$crs', '$enc_pass')") or die('ERR S00');

       if ($j < $i){
         header('location: ../home/home.php');
       }
      }else{
        //$message[] = "something went wrong!";
      }


    }
  } else{
    $message[] ="Please provide correct Details!";
  }
}

// unset($message_pos);
  // $insert = mysqli_query($conn, "INSERT INTO `organization_pos` (organization_id, course, required_pos) VALUES('$id', '$course', '$pos')") or die('query failed');



}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../assets/css/style-min.css">

   <style>
  .container_c {
   display: block;
   position: relative;
   padding-left: 35px;
   margin-bottom: 12px;
   cursor: pointer;
   font-size: 22px;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
 }
 
 /* Hide the browser's default checkbox */
 .container_c input {
   position: absolute;
   opacity: 0;
   cursor: pointer;
   height: 0;
   width: 0;
 }
 
 /* Create a custom checkbox */
 .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   height: 25px;
   width: 25px;
   background-color: #eee;
 }
 
 /* On mouse-over, add a grey background color */
 .container_c :hover input ~ .checkmark {
   background-color: #ccc;
 }
 
 /* When the checkbox is checked, add a blue background */
 .container_c input:checked ~ .checkmark {
   background-color: #2196F3;
 }
 
 /* Create the checkmark/indicator (hidden when not checked) */
 .checkmark:after {
   content: "";
   position: absolute;
   display: none;
 }
 
 /* Show the checkmark when checked */
 .container_c input:checked ~ .checkmark:after {
   display: block;
 }
 
 /* Style the checkmark/indicator */
 .container_c .checkmark:after {
   left: 9px;
   top: 5px;
   width: 5px;
   height: 10px;
   border: solid white;
   border-width: 0 3px 3px 0;
   -webkit-transform: rotate(45deg);
   -ms-transform: rotate(45deg);
   transform: rotate(45deg);
 }

 .box{
   width: 100%;
   border-radius: 5px;
   background-color: var(--light-bg);
   padding:12px 14px;
   font-size: 17px;
   color:var(--black);
   margin-top: 10px;
}

   </style>

</head>
<body>

   
<div class="update-profile">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Specify available position for each course</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
    //   if(isset($message_pos)){
    //     foreach($message_pos as $message){
    //        echo '<div class="message">'.$message.'</div>';
    //     }
    //  }
      ?>
      <div class="flex" style = "height: 680px;  width: 600px;">
      <div style="margin-top: 20px;">
      <label>Course</label>
         <label class="container_c">Accounting
                <input type="checkbox" id="" name="acc" value="ACC">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 135px;">Banking and Finance
                <input type="checkbox" name="bf" value="BAF">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 135px;">Information Technology
                <input type="checkbox" name="it" value="IT">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 135px;">Computer scince
                <input type="checkbox" name="cs" value="CS">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 135px;">Social Protection
                <input type="checkbox" id="" name="sp" value="SP">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 145px;">Taxation
                <input type="checkbox" name="tx" value="TAX">
                <span class="checkmark"></span>
                </label>
                <label class="container_c" style="margin-top: 135px;">Accounting with IT
                <input type="checkbox" name="bait" value="BAIT">
                <span class="checkmark"></span>
                </label>
                <label class="container_c"style="margin-top: 133px;">Economics and Finance
                <input type="checkbox" name="bef" value="BEF">
                <span class="checkmark"></span>
                </label>
                <label class="container_c"style="margin-top: 160px;">Insurance and Risk Management
                <input type="checkbox" name="ir" value="IR">
                <span class="checkmark"></span>
                </label>
                <label class="container_c"style="margin-top: 163px;">Actuarial Science
                <input type="checkbox" name="acs" value="ACS">
                <span class="checkmark"></span>
                </label>
    </div>
      <hr>
      <div style="width: 200px;">
         <label>Number of students</label>
               <input type="number" id="acc" name="acc_pos" placeholder="" class="box">
               <input type="text" name="sname_acc" placeholder="supervisor name" class="box">
               <input type="email" name="semail_acc" placeholder="supervisor Email" class="box">
               <input type="number" name="bf_pos" placeholder="" class="box">
               <input type="text" name="sname_bf" placeholder="supervisor name" class="box">
               <input type="email" name="semail_bf" placeholder="supervisor Email" class="box">
               <input type="number" name="it_pos" placeholder="" class="box">
               <input type="text" name="sname_it" placeholder="supervisor name" class="box">
               <input type="email" name="semail_it" placeholder="supervisor Email" class="box">
               <input type="number" name="cs_pos" placeholder="" class="box">
               <input type="text" name="sname_cs" placeholder="supervisor name" class="box">
               <input type="email" name="semail_cs" placeholder="supervisor Email" class="box">
               <input type="number" id="" name="sp_pos" placeholder="check option first" class="box">
               <input type="text" name="sname_sp" placeholder="supervisor name" class="box">
               <input type="email" name="semail_sp" placeholder="supervisor Email" class="box">
               <input type="number" name="tx_pos" placeholder="" class="box">
               <input type="text" name="sname_tx" placeholder="supervisor name" class="box">
               <input type="email" name="semail_tx" placeholder="supervisor Email" class="box">
               <input type="number" name="bait_pos" placeholder="" class="box">
               <input type="text" name="sname_bait" placeholder="supervisor name" class="box">
               <input type="email" name="semail_bait" placeholder="supervisor Email" class="box">
               <input type="number" name="bef_pos" placeholder="" class="box">
               <input type="text" name="sname_bef" placeholder="supervisor name" class="box">
               <input type="email" name="semail_bef" placeholder="supervisor Email" class="box">
               <input type="number" style="margin-top: 35px;" name="ir_pos" placeholder="" class="box">
               <input type="text" name="sname_ir" placeholder="supervisor name" class="box">
               <input type="email" name="semail_ir" placeholder="supervisor Email" class="box">
               <input type="number" style="margin-top: 35px;" name="acs_pos" placeholder="" class="box">
               <input type="text" name="sname_acs" placeholder="supervisor name" class="box">
               <input type="email" name="semail_acs" placeholder="supervisor Email" class="box">
         </div>
   </div>
  
   
      

      <input type="submit" name="submit-pos" value="Continue" class="btn">
      <!--<p>already have an account? <a href="login.php">login now</a></p>-->
   </form>
        </div>

        <script>
			document.getElementById("chk_acc").addEventListener("click", position);

			document.getElementById("rm").addEventListener("click", type_of_farming);


			function position() {
				if (document.getElementById("chk_acc").checked) {
          document.getElementById("acc").removeAttribute("readonly");
  					 document.getElementById("acc").setAttribute("Placeholder", "Accouting");
				}else if(!(document.getElementById("chk_acc").checked)){
          document.getElementById("acc").setAttribute("Placeholder", "check course first");
          document.getElementById("acc").setAttribute("readonly", true);
        }
				
			}
		</script>
</body>

</html>