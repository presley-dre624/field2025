<?php

include '../config.php';
session_start();
$uid = $_SESSION['uid'];
error_reporting(0);

if(!isset($uid)){
   header('location:../');
};

if(isset($_GET['logout'])){
   unset($uid);
   session_destroy();
   header('location:../');
}

$studentid = $_SESSION['student'];

$select_student = mysqli_query($conn, "SELECT s.id, su.supervisor_name, su.email, student_logbook.logbook_id, first_name, middle_name, surname,ld.date, task, lesson from student s
                                join accepted_application a on s.id = a.student_id
                                join organization o on a.organization_id = o.id
                                join supervisors su on o.id = su.organization
                                join student_logbook on s.id = student_logbook.student
                                join logbook_data ld on ld.logbook = student_logbook.logbook_id
                                where s.id = '$studentid'
                                limit 1") or die('something went wrong1');
$res = mysqli_fetch_assoc($select_student);
$course = $res['course'];
$date = $res['date'];
$logbookid = $res['logbook_id'];

if (isset($_GET['date'])){
  $date = $_GET['date'];
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>university- Dashboard</title>
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
      <a href="home.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">University</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
    <?php
         $select = mysqli_query($conn, "SELECT * FROM `university` WHERE id = '$uid'") or die('query failed');
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
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fetch['name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fetch['name']; ?></h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="home.php?logout=<?php echo $uid; ?>">
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
            <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
              <li>
                <a href="allocation.php" class = "active">
                  <i class="bi bi-circle"></i><span>Student with allocation</span>
                </a>
              </li>
              <li>
                <a href="noallocation.php">
                  <i class="bi bi-circle"></i><span>Student without allocation</span>
                </a>
              </li>
            </ul>
          </li><!-- End Application Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">


         
    <div class="pagetitle">
      <h1>Student details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Student Allocations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
    <div class="col-xl-4">

                      <!-- <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                          <h2>Kevin Anderson</h2>
                        </div>
                      </div> -->

                      </div>

                      <div class="col-xl-8">
                      <?php
                              if(isset($message)){
                                foreach($message as $message){
                                    echo '<div class="message">'.$message.'</div>';
                                }
                              }
                        ?>

                      <div class="card">
                      <div class="card-body pt-3">
                      <!-- Bordered Tabs -->
                      <ul class="nav nav-tabs nav-tabs-bordered">

                      <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Logbook</button>
                      </li>

                      <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#comments">Supervisor Comments</button>
                      </li>

                      <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Evaluation details</button>
                      </li>


                      </ul>
                      <div class="tab-content pt-2">
                        <?php
                            $select_student = mysqli_query($conn, "SELECT s.id, su.supervisor_name, su.email, first_name, middle_name, surname,ld.date, task, lesson from student s
                            join accepted_application a on s.id = a.student_id
                            join organization o on a.organization_id = o.id
                            join supervisors su on o.id = su.organization
                            join student_logbook on s.id = student_logbook.student
                            join logbook_data ld on ld.logbook = student_logbook.logbook_id
                            where s.id = '$studentid' and ld.date = '$date'") or die('something went wrong2');
                                $res_data = mysqli_fetch_assoc($select_student);
                              
                        ?>

                      <div class="tab-pane fade show active profile-overview" id="profile-overview">

                      <h5 class="card-title"></h5>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Supervisor name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['supervisor_name']; ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Supervisor email</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['email']; ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['first_name'].' '.$res_data['middle_name'].' '.$res_data['surname']; ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['date']; ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Task</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['task']; ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Lesson</div>
                        <div class="col-lg-9 col-md-8"><?php echo $res_data['lesson']; ?></div>
                      </div>

                      <?php
                            $next = mysqli_query($conn, "SELECT * FROM logbook_data where date > '$date' and logbook = '$logbookid'");
                            if($row = mysqli_fetch_array($next)){
                              echo '<a href="student.php?date='.$row['date'].'"><button class="btn btn-primary" type="submit">Next</button></a>';
                            }


                            $prev = mysqli_query($conn, "SELECT * FROM logbook_data where date < '$date' and logbook = '$logbookid' order by date DESC");
                            if($row = mysqli_fetch_array($prev)){
                              echo '<a href="student.php?date='.$row['date'].'"><button class="btn btn-primary" type="submit">Prev</button></a>';
                            }
                       ?>



                      </div>

                      <div class="tab-pane fade pt-3" id="comments">
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date</div>
                        <div class="col-lg-9 col-md-8"><?php //echo date("Y-m-d"); ?></div>
                      </div><br>
                      <form method = "POST" action = "student-logbook.php">
                      <div class="row mb-3">
                                    <label for="comments" class="col-md-4 col-lg-3 col-form-label">Comments</label>
                                  
                                    </div>
                                  </div>
                      </form>

                      </div>


                      </div><!-- End Bordered Tabs -->

                      </div>
                      </div>

                      </div>
      <!-- </div> -->
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