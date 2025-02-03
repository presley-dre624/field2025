<?php

include '../config.php';
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, strtoupper(trim($_POST['name'])));
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $email = mysqli_real_escape_string($conn, strtolower(trim($_POST['email'])));
   $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
   $region = mysqli_real_escape_string($conn, strtoupper($_POST['region']));
   $district = mysqli_real_escape_string($conn, strtoupper($_POST['district']));
   $ward = mysqli_real_escape_string($conn, strtoupper($_POST['ward']));
   $village = mysqli_real_escape_string($conn, strtoupper($_POST['village']));

   $select = mysqli_query($conn, "SELECT * FROM `organization` WHERE email = '$email' AND pass = '$pass'") or die('query failed1');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else if( $region == 'region' || $district == 'district' || $ward == 'ward'){
         $message[] = 'please confirm your location details!';
      }else if(!is_numeric($phone) || strlen($phone) != 10){
         $message[] = 'Invalid Phone number!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `organization` (name, email, phone, pass, region, district, ward, village) VALUES('$name', '$email', '$phone', '$pass', '$region', '$district', '$ward', '$village')") or die('query failed');

         if($insert){
            $select = mysqli_query($conn, "SELECT * FROM `organization` WHERE email = '$email'") or die('query failed');
            $row = mysqli_fetch_assoc($select);
            $id = $row['id'];
            $_SESSION['oid'] = $id;
            $message[] = 'registered successfully!';
            header('location:positions.php');
         }else{
            $message[] = 'registeration failed!';
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
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../assets/css/style-min.css">

</head>
<body>
   
<div class="update-profile">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>ORGANIZATION DETAILS</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="flex" style = "height: 200px;">
         <div class = "inputBox">
               <input type="text" name="name" placeholder="Organization name" class="box" required>
               <input type="email" name="email" placeholder="Email" class="box">
               <input type="text" name="phone" placeholder="Phone number eg 075.." class="box" required>
         </div>
      <hr>
         <div class = "inputBox">
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
              
         </div>
   </div>
   <h3>LOCATION</h3>
   <div class="flex" style = "height: 220px;">
         <div class = "inputBox">
         <span>Region</span>
         <select name="region" id="region" onchange="populate_district(this.id,'district')" class="box" required>
                                <option value="region"><b>-Select Region</b></option>
                                <option value="dar-es-salaam"><b>DAR-ES-SALAAM</b></option>
                                <option value="arusha"><b>ARUSHA</b></option>
         </select>
         <br>
         <span>District</span>
               <select name="district" id="district" onchange="populate_ward(this.id,'ward')" class="box" required>
                  <option value="" selected><b>-Select Region first</b></option>
               </select>
         
         </div>
      <hr>
         <div class = "inputBox">
               <span>Ward</span>
         <select name="ward" id="ward" onchange="populate_village(this.id,'village')" class="box" required>
                  <option value="" selected><b>-Select District first</b></option>
               </select>
               <span>Village</span>
               <select name="village" id="village" class="box" required>
                  <option value="" selected><b>-Select Ward first</b></option>
               </select>
         </div>
   </div>
   
      

      <input type="submit" name="submit" value="Register" class="btn">
      <p>already have an account? <a href="../">Sign in</a></p>
   </form>

</div>



<script>
            function populate_district(s1,s2)
            {
                var s1 = document.getElementById(s1);
                var s2 = document.getElementById(s2);

                     
             s2.innerHTML="";

             if(s1.value=="dar-es-salaam")
             {
                var optionArray = ['district|-Select Region first','ilala|ILALA','kinondoni|KINONDONI','kigamboni|KIGAMBONI','ubungo|UBUNGO'];
             }
             else if(s1.value=="arusha")
             {
                var optionArray = ['district|-Select Region first','karatu|KARATU','arumeru|ARUMERU','arusha town|ARUSHA TOWN'];
             }
              else if(s1.value=="mwanza")
             {
                var optionArray = ['district|-Select Region first','ilemela|Ilemela','nyamagana|Nyamagana','kwimba|Kwimba','magu|Magu','ukerewe|Ukerewe'];
             }

             else if(s1.value=="tanga")
             {
                var optionArray = ['district|-Select Region first','tanga mjini|Tanga Mjini','muheza|Muheza','handeni|Handeni','lushoto|Lushoto','maramba|Maramba'];
             }

            else if(s1.value=="mbeya")
             {
                var optionArray = ['district|-Select Region first','tukuyu|Tukuyu','mbozi|Mbozi','kyela|Kyela','uyole|Uyole','tunduma|Tunduma'];
             }
             else if(s1.value=="region")
             {
                var optionArray = ['district|-Select Region first'];
             }




             for(var option in optionArray){
                var pair = optionArray[option].split("|");
                var newoption = document.createElement("option");

                newoption.value = pair[0];
                newoption.innerHTML = pair[1];
                s2.options.add(newoption);
             }

            }


            function populate_ward(s2,s3)
            {
                var s2 = document.getElementById(s2);
                var s3 = document.getElementById(s3);


                s3.innerHTML="";
                document.getElementById('village').innerHTML = "";

                var newoption_w = document.createElement("option");
                newoption_w.innerHTML = "-Select Ward first";
                document.getElementById('village').options.add(newoption_w);

             if(s2.value=="ilala")
             {
                var optionArray = ['ward|-Select District first','ilala|ILALA','kisutu|KISUTU','kivukoni|KIVUKONI','upanga|UPANGA'];
             }
             else if(s2.value=="kigamboni")
             {
                var optionArray = ['ward|-Select District first','kigamboni|KIGAMBONI','tungi|TUNGI','kimbiji|KIMBIJI','kibada|KIBADA'];
             }
              else if(s2.value=="kinondoni")
             {
                var optionArray = ['ward|-Select District first','kijitonyama|KIJITONYAMA','kawe|KAWE','makumbusho|MAKUMBUSHO','mikocheni|MIKOCHENI'];
             }

             else if(s2.value=="ubungo")
             {
                var optionArray = ['ward|-Select District first','kimara|KIMARA','ubungo|UBUNGO'];
             }

            else if(s2.value=="karatu")
             {
                var optionArray = ['ward|-Select District first','karatu|KARATU','mbulumbulu|MBULUMBULU','eyasi|EYASI'];
             }
             else if(s2.value=="arumeru")
             {
                var optionArray = ['ward|-Select District first','usa river|USA RIVER','oljoro|OLJORO','maji ya chai|MAJI YA CHAI'];
             }
             else if(s2.value=="arusha town")
             {
                var optionArray = ['ward|-Select District first','ngarenaro|NGARENARO','sakina|SAKINA','daraja mbili|DARAJA MBILI','kaloleni|KALOLENI'];
             }
             else if(s2.value=="district")
             {
                var optionArray = ['-ward|-Select District first'];
             }




             for(var option in optionArray){
                var pair = optionArray[option].split("|");
                var newoption = document.createElement("option");

                newoption.value = pair[0];
                newoption.innerHTML = pair[1];
                s3.options.add(newoption);
             }

            }


            function populate_village(s3,s4)
            {
                var s3 = document.getElementById(s3);
                var s4 = document.getElementById(s4);

                s4.innerHTML ="-Select ward first";

                var newoption = document.createElement("option");

                newoption.value = s3.value;
                newoption.innerHTML = s3.value.toUpperCase();
                s4.options.add(newoption);
             }
        </script>

</body>
</html>