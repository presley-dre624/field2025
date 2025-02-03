<?php

include '../config/config.php';
session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];
$id = $user_id;//for table results

if(!isset($user_id)){
   header('location:../');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../');
}



if (!isset($_SESSION['s-cousre']) && !isset($_SESSION['s-region']) && !isset($_SESSION['s-district'])){
  header('location: application.php');
}else{
  $course = $_SESSION['s-course'];
  $region = $_SESSION['s-region'];
  $district = $_SESSION['s-district'];

  $select_org = mysqli_query($conn, "SELECT DISTINCT id,name, region, district, village, ward FROM organization o
  join organization_pos op on o.id = op.organization_id
  join organization_ocupied_pos oop on o.id = oop.oid 
  Where op.course = '$course' and oop.course = '$course' and o.region = '$region' and o.district = '$district'
  and (op.required_pos - oop.pos) > 0
  order by id");
}

$_SESSION['sid'] = trim($_POST['id']);

echo $_SESSION['sid'];
// if (isset($_POST['apply'])){
//     $_SESSION['sid'] = trim($_POST['id']);
// }

//echo $_SESSION['sid'];


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Field- Application</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <!-- custom css file link  -->
  <link rel="stylesheet" href="../assets/css/style-min.css">

  <link rel="stylesheet"  href="../assets/css/table-style.css">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Student</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

       <!-- End Search Icon-->

        

         <!--Notifications-->


        <!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <?php
                $select = mysqli_query($conn, "SELECT * FROM `student` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
            ?>
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['surname']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fetch['first_name']; ?></h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php?logout=<?php echo $user_id; ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-grid"></i>
          <span>Profile</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <!-- End Components Nav -->

      <!-- End Forms Nav -->

      <!-- End Tables Nav -->

      <!-- End Charts Nav -->

      <!-- End Icons Nav -->

      <!-- <li class="nav-heading">Pages</li> -->

      <!-- End Profile Page Nav -->

      <!-- End F.A.Q Page Nav -->

      <!-- End Contact Page Nav -->

      <!-- End Register Page Nav -->

      <!-- End Login Page Nav -->

      <!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="bi bi-card-list"></i>
          <span>Application</span>
        </a>
      </li><!-- End Application Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active">Application</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="container">
                <h1>Field Application</h1>
                <table class="rwd-table">
                    <tbody>
                    <tr>
                    <th>#</th>
                        <th>Organization Name</th>
                        <th>Region</th>
                        <th>District</th>
                        <th>Ward</th>
                        <!-- <th>Due Date</th> -->
                        <th></th>
                    </tr>
                        <?php while ($result = mysqli_fetch_assoc($select_org))
                        {
                            ?>
                    <tr>
                    <td data-th="Supplier Code">
                        <?php echo $result['id']; ?>
                        </td>
                        <td data-th="Supplier Code">
                        <?php echo $result['name']; ?>
                        </td>
                        <td data-th="Supplier Name">
                        <?php echo $result['region']; ?>
                        </td>
                        <td data-th="Invoice Number">
                        <?php echo $result['district']; ?>
                        </td>
                        <td data-th="Invoice Date">
                        <?php echo $result['ward']; ?>
                        </td>
                        <!-- <td data-th="Due Date">
                        12/25/2016d
                        </td> -->
                        <td data-th="Net Amount">
                            <?php 
                            $orgid = $result['id'];
                            $select_app = mysqli_query($conn, "SELECT * FROM application where student_id = '$id' AND organization_id = '$orgid'");
                            $rejectect = mysqli_query($conn, "SELECT * FROM rejected_application where student_id = '$id' AND organization_id = '$orgid'");
                            $accepted = mysqli_query($conn, "SELECT * FROM accepted_application where student_id = '$id' AND organization_id = '$orgid'");

                                    if((mysqli_num_rows($select_app) > 0) || (mysqli_num_rows($rejectect) > 0) || (mysqli_num_rows($accepted) > 0)){
                                            echo 'Applied';
                                    }else{
                                             echo'<a href="apply.php" class="btnClick" style="width: 100;
                                                            border-radius: 5px;
                                                            padding:10px 30px;
                                                            color:#fff;
                                                            display: block;
                                                            text-align: center;
                                                            cursor: pointer;
                                                            font-size: 20px;
                                                            margin-top: 10px;
                                                            background-color:#3498db;
                                                            text-decoration: none">
                                              Apply</a>';
                    }
                        
                        ?>
                        </td>
                    </tr>
                    <?php
                        }
                        ?>
                    </tbody>
                </table>
                
                </div>
    
    
    <script type="text/javascript">
        $(function(){
            $('.btnClick').click(function(){
                var $row = $(this).closest('tr');
                var $td = $row.find('td').eq(0);
                //alert($($td).text());
                
                var org = {};
                org.id = $td.text();
                console.log(org);

                $.ajax({
                    method: 'POST',
                    url: 'results.php',
                    data: org,
                     success: function(res){
                        console.log(res);
                     }
                });

            });
        });
        
    </script>


      <!-- <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Info</h5>
              <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Example Card</h5>
              <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
            </div>
          </div>

        </div>
      </div> -->
    </section>

  </main><!-- End #main -->

  <!--footer-->
   <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Field Management system</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>


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