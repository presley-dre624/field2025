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


$data = mysqli_query($conn, "SELECT first_name, middle_name, surname, logbook_id, ld.date, task, lesson from student s
                join student_logbook l on s.id = l.student
                join logbook_data ld on l.logbook_id = ld.logbook
                where s.id = '$user_id'
                ORDER BY ld.date ASC
                LIMIT 1") or die('ERR LD00');
$res = mysqli_fetch_assoc($data);
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

  <title>Student- Logbook</title>
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
  <!-- min css-->
  <link href="../assets/css/style-min.css" rel="stylesheet">

  <style> 
  textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
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
    <a class="nav-link collapsed" href="index.php">
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
  
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>My Logbook</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
      <li>
        <a href="logbook.php" >
          <i class="bi bi-circle"></i><span>Add Today entry</span>
        </a>
      </li>
      <li>
        <a href="mylogbook.php" class="active">
          <i class="bi bi-circle"></i><span>View</span>
        </a>
      </li>
    </ul>
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
  
  

</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Logbook</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="../index.html">My Logbook</a></li> -->
          <li class="breadcrumb-item active">My Entries</li>
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



</ul>
<div class="tab-content pt-2">
<?php
$data = mysqli_query($conn, "SELECT first_name, middle_name, surname, logbook_id, ld.date, task, lesson from student s
    join student_logbook l on s.id = l.student
    join logbook_data ld on l.logbook_id = ld.logbook
    where s.id = '$user_id' and ld.date = '$date'") or die('ERR LD01');
    $res_data = mysqli_fetch_assoc($data);
?>


<div class="tab-pane fade show active profile-overview" id="profile-overview">

<h5 class="card-title"></h5>

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
    echo '<a href="mylogbook.php?date='.$row['date'].'"><button class="btn btn-primary" type="submit">Next</button></a>';
   }


   $prev = mysqli_query($conn, "SELECT * FROM logbook_data where date < '$date' and logbook = '$logbookid' order by date DESC");
   if($row = mysqli_fetch_array($prev)){
    echo '<a href="mylogbook.php?date='.$row['date'].'"><button class="btn btn-primary" type="submit">Prev</button></a>';
   }
?>

</div>
</div>


    </div><!-- End Bordered Tabs -->

  </div>
</div>


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

</body>

</html>