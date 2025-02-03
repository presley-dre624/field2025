<?php
include '../config.php';
error_reporting(0);
session_start();
$supervisorid = $_SESSION['supervisor'];

if(!isset($supervisorid)){
  header('location: ../');
}
if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header('location:../');
}


$_SESSION['student'] = trim($_POST['id']);

$students = mysqli_query($conn, "SELECT s.id, first_name, middle_name, surname, University, s.course, regno from student s
                join accepted_application a on s.id = a.student_id
                join organization o on a.organization_id = o.id
                join supervisors su on su.organization = o.id
                where su.supervisor_id = '$supervisorid' and su.course = s.course") or die('failed to select student info');



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Supervisor- Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet"  href="../assets/css/table-style.css">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  <?php
    $select = mysqli_query($conn, "SELECT * FROM supervisors where supervisor_id = '$supervisorid'") or die('ERR SS00');
    $fetch = mysqli_fetch_assoc($select);
  ?>



    <div class="d-flex align-items-center justify-content-between">
      <a href="home.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Supervisor</span>
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
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fetch['supervisor_name'];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fetch['supervisor_name'];?></h6>
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
              <a class="dropdown-item d-flex align-items-center" href="home.php?logout=<?php echo $supervisorid; ?>">
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
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End my students Page Nav -->
      <li class="nav-item">
        <a class="nav-link " href="mystudents.php">
          <i class="bi bi-card-list"></i>
          <span>My students</span>
        </a>
      </li><!-- End Application Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">My students</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">


              <div class="container" style = "display: block;" >
                        <h1></h1>
                        <table class="rwd-table">
                            <tbody>
                            <tr>
                            <th>#</th>
                                <th>Student Name</th>
                                <th>University</th>
                                <th>course</th>
                                <th>Registration Number</th>
                                <th></th>
                            </tr>
                                <?php while ($result = mysqli_fetch_assoc($students))
                                {
                                    ?>
                            <tr>
                            <td data-th="Supplier Code">
                                <?php echo $result['id']; ?>
                                </td>
                                <td data-th="Supplier Code">
                                <?php echo $result['first_name'].' '.$result['middle_name'].' '.$result['surname'];?>
                                </td>
                                <td data-th="Supplier Name">
                                <?php echo $result['University'];?>
                                </td>
                                <td data-th="Invoice Number">
                                <?php echo $result['course'];?>
                                </td>
                                <td data-th="Invoice Date">
                                <?php echo $result['regno'];?>
                                </td>
                                <!-- <td data-th="Due Date">
                                12/25/2016d
                                </td> -->
                                <td data-th="Net Amount">
                                  <a href="student-logbook.php" class="btnClick" style=" width: 140;
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
                                Activities</a>
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
                        //alert ($($td).text());
                        
                        var student = {};
                        student.id = $td.text();
                        console.log(student);

                        $.ajax({
                            method: 'POST',
                            url: 'mystudents.php',
                            data: student,
                            success: function(res){
                                console.log(res);
                            }
                        });

                    });
                });
                
            </script>

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