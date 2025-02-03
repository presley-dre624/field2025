<?php

include '../config.php';
session_start();
$oid = $_SESSION['oid'];

if(!isset($oid)){
   header('location:../');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../');
}
$date = "";

$studentid = $_SESSION['student'];

$select_student = mysqli_query($conn, "SELECT first_name,middle_name,surname,gender, University, course, regno, email,phonenumber,field_letter FROM student s
                        join application a on s.id = a.student_id
                        where a.student_id = '$studentid'") or die('something went wrong');

$result = mysqli_fetch_assoc($select_student);
$course = $result['course'];

if (isset($_POST['accept'])){

  $day = $_POST['date-day'];
  $month = $_POST['date-month'];
  $year = $_POST['date-year'];

  $date .= trim($year).'-'.trim($month).'-'.trim($day);
  $stdate = trim($date);
  

     $insert = mysqli_query($conn, "INSERT into accepted_application (organization_id, student_id, startdate) VALUES ('$oid','$studentid','$stdate')") or die('something went WRONG! acc001');
     if ($insert){
         $ocu = mysqli_query($conn, "UPDATE organization_ocupied_pos set pos = pos + 1 where oid = '$oid' and course = '$course'") or die ('couldnt update position');
         $dlt = mysqli_query($conn, "DELETE FROM application WHERE student_id = '$studentid'") or die('Something went WRONG! dc001');
         $info = mysqli_query($conn, "INSERT INTO info (student, info) VALUES ('$studentid', 'Your Field application Has been Accepted!')") or die('something went WRONG! failed to add info');
         $log = mysqli_query($conn, "INSERT INTO student_logbook(student, score) VALUES('$studentid', 100)") or die('logbook not created');
         $super = mysqli_query($conn, "SELECT supervisor_id from supervisors where course = '$course' and organization = '$oid'") or die('no super');
            $super_data = mysqli_fetch_assoc($super);
            $super_id = $super_data['supervisor_id'];
         $student_log = mysqli_query($conn, "SELECT logbook_id from student_logbook where student = '$studentid'") or die('no logbook');
            $student_log_data = mysqli_fetch_assoc($student_log);
            $student_log_id = $student_log_data['logbook_id'];
          $super_log  = mysqli_query($conn, "INSERT INTO logbook_supervisor(supervisor, logbook, score) VALUES('$super_id', $student_log_id, 0)") or die('could not assign logbook');
         if ($dlt && $log && $ocu &&$info){
              header('location: applications.php');
              unset($_SESSION['student']);
         }
     }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Organization- Dashboard</title>
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

  <!-- min css -->
  <link href="../assets/css/style-min.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="home.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Organization</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
    <?php
         $select = mysqli_query($conn, "SELECT * FROM `organization` WHERE id = '$oid'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
      ?>
      <ul class="d-flex align-items-center">

       <!-- End Search Icon-->

        

         <!--Notifications-->


        <!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fetch['name'].'-'.$fetch['district']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fetch['name'].'-'.$fetch['district']; ?></h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="home.php?logout=<?php echo $oid; ?>">
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
        <a class="nav-link collapsed" href="home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

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
          <span>Student Applications</span>
        </a>
      </li><!-- End Application Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">


         
    <div class="pagetitle">
      <h1>Student details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Startdate</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class = "update-profile">
          <form method ="post" enctype="multipart/form-data">
          <div class = "flex" style = "height: 25px;">
                <span>Specify Startdate for:</span>
            </div>


            <div class = "flex" style = "height: 25px;">
                <span><?php echo $result['first_name'].' '.$result['middle_name'].' '.$result['surname']; ?></span>
            </div>





            <div class = "flex" style = "height: 60px;">
              <div class ="inputBox">
                  <select name="date-day" id="region" class="box" required>
                                            <option value="" disabled selected><b>Day</b></option>
                                            <option value="21"><b>21</b></option>
                                            <option value="22"><b>22</b></option>
                                            <option value="23"><b>23</b></option>
                                            <option value="24"><b>24</b></option>
                                            <option value="25"><b>25</b></option>
                                            <option value="26"><b>26</b></option>
                                            <option value="27"><b>27</b></option>
                                            <option value="28"><b>28</b></option>
                    </select>
              </div>
      
            <div class ="inputBox">
                <select name="date-month" id="region" class="box" required>
                                        <option value="" disabled selected><b>Month</b></option>
                                        <option value="02"><b>February</b></option>
                </select>
            </div>

            <div class ="inputBox">
                <select name="date-year" id="region" class="box" required>
                                        <option value="" selected disabled><b>Year</b></option>
                                        <option value="2023"><b>2023</b></option>
                </select>
            </div>
        </div>
            <input type = "submit" class="btn" name="accept" value="Accept">
          </form>
    </div>
    </section>







    <!-- <section class="section">
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
          <h4><?php echo $studentid.$oid.$course; ?></h4>
            <span>Student Name:</span>    <span style = "color: green;"><?php echo $result['first_name'].' '.$result['middle_name'].' '.$result['surname'];?></span><br>
            <label>University</label> <?php echo $result['University']; ?><br>
            <label>Course: </label> <?php echo $result['course']; ?><br>
            <label>Registration number: </label> <?php echo $result['regno']; ?><br>
            <label>Gender:</label> <span style = "color: green;"><?php echo $result['gender']; ?></span><br>
            <label>Email:</label> <span style = "color: green;"><?php echo $result['email']; ?></span><br>
            <label>Phone:</label> <span style = "color: green;"><?php echo $result['phonenumber']; ?></span><br>

            <label>field letter: </label> <a href="../../student/uploaded_field_letter/<?php echo $result['field_letter']?>">Download</a>

            <input type = "submit" class="btn" name="accept" value="Accept Application">
            <input type = "submit" class="delete-btn" name="reject" value="Reject Application">
      
   </form> -->



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