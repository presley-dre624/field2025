<?php

include '../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student- Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
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
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
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
        <a class="nav-link " href="#">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <?php 
      $accepted = mysqli_query($conn, "SELECT * FROM accepted_application where student_id = '$user_id' "); 
      if (mysqli_num_rows($accepted) > 0){

      }else{
        echo'
        <li class="nav-item">
          <a class="nav-link collapsed" href="application.php">
            <i class="bi bi-card-list"></i>
            <span>Application</span>
          </a>
       </li><!-- End Application Page Nav -->';
      }
      ?>



      <?php
        $date = date("Y/m/d");
        $res_date = mysqli_fetch_assoc($accepted);
        if (mysqli_num_rows($accepted) > 0) {
          if ($date >= date("Y/m/d", strtotime($res_date['startdate']))){
            echo'<li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>My Logbook</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="logbook.php">
                  <i class="bi bi-circle"></i><span>Add Today entry</span>
                </a>
              </li>
              <li>
                <a href="mylogbook.php">
                  <i class="bi bi-circle"></i><span>View</span>
                </a>
              </li>
          </li>';
          }else{
            
          }
        }else{
  
        }
        
        ?>
      
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
      
      

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Welcome</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h4><?php echo $fetch['first_name']; ?></h4>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body"><br>

                <?php
                        $app = mysqli_query($conn,"SELECT * FROM application WHERE student_id = '$user_id'") or die('Something went Wrong!');
                        $selection = mysqli_query($conn, "SELECT * FROM accepted_application WHERE student_id = '$user_id'") or die ('ERR s001');
                        if ((mysqli_num_rows($app) > 0) || mysqli_num_rows($selection) > 0){

                          $info = mysqli_query($conn, "SELECT info from info where student = '$user_id'") or die('Something went Wrong!, could not find student info');
                          if(mysqli_num_rows($info) > 0){
                            $row = mysqli_fetch_assoc($info);
                            echo ' <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-info"></i>
                            </div>
                              <div class="ps-3">
                                <span>  SELECTION STATUS: '.$row['info'].' <a href="selection-details.php">click here for more details</a>, Make sure to keep note of your startdate to start filling the logbook
                                </span>

                              </div>
                              </div>
                              ';

                          }else{
                            echo ' <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-x"></i>
                            </div>
                              <div class="ps-3">
                                <span>  
                                SELECTION STATUS: Not selected
                                </span>

                              </div>
                              </div>
                              ';
                          }

                        }else{
                            echo '<div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-info"></i>
                            </div>
                            <div class="ps-3">
                              <span class="text-danger small pt-1 fw-bold">You haven\'t made any application yet</span>
                            </div>
                          </div>';
                        }
                        
                        ?>


                  <?php if (isset($_SESSION['msg'])){
                    echo '<div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-info"></i>
                    </div>
                      <div class="ps-3">
                        <span>'.$_SESSION['msg'].'
                        </span>

                      </div>
                      </div>
                      ';
                      unset($_SESSION['msg']);
                    } 
                    ?>
                      
                <?php 

               ?>   

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
           <!-- End Reports -->

            <!-- Recent Sales -->
            <!-- End Recent Sales -->

            <!-- Top Selling -->
            <!-- End Top Selling -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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

</body>

</html>