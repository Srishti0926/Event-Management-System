<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventmanagement";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if(array_key_exists('logout', $_POST)) {
  logout();
}

function logout() {
  if(isset($_SESSION['user_id'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['type']);
    header("Location: login.php");
  } else {
    header("Location: login.php");
  }
}

if(array_key_exists('register',$_POST)){
  $eventId = 1;
  register($eventId);
}

function register($eventId) {
  $servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventmanagement";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
  
    $student = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM student_details WHERE StudentId = '" . $_SESSION['user_id']. "'"));
    $res= mysqli_query($conn, "INSERT INTO `participation` (`EventId`, `StudentId`) VALUES( '".$eventId."','".$student['StudentId']."')");
}

?>


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

  <title>VESIT Events Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <!-- =======================================================
  * Template Name: Arsha - v2.3.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center" >
      
      <h1 class="logo mr-auto"><a href="index.html" style="text-decoration: none;">VESIT EVENTS DASHBOARD</a></h1>
    
   
          
      <nav class="nav-menu d-none d-lg-block" style="float: right; ">
        <ul style="align-items: center;">
        <?php if (isset($_SESSION['user_id'])) { 
            if ($_SESSION['type']=='host') {?>
        <li ><a href="createevent.php" style="text-decoration: none;">Create Event</a></li>
        <li ><a href="editevent.php" style="text-decoration: none;">Edit Event</a></li>
        <?php }
        }
        ?>
          <li ><a href="" style="text-decoration: none;">Dashboard</a></li>
          <li><a href="reports.php" style="text-decoration: none;">Reports</a></li>
          <?php if (isset($_SESSION['user_id'])) { ?>
              <li> <strong> <p class='User' style="color: white; font-size:18px; "> <?php echo $_SESSION['username']." | ".$_SESSION['type']; ?> </p></strong></li>
              <li> <form method="post">
                      <input type="submit" name="logout" class="button" value="Logout" /> 
                    </form>
              </li>
          <?php } 
          else {  ?>
              <li><a href="login.php" style="text-decoration: none;">Login</a></li>
              <li ><a href="signup.php" style="text-decoration: none;">Sign Up</a></li> 
          <?php } ?>  
          
        </ul>

      </nav><!-- .nav-menu -->

  
    </div>
  </header>
<!-- End Header -->

<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="background-image: url(assets/img/dashboard_bg.jpg); background-repeat: no-repeat; background-size: cover; background-position: center;position: relative;">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>EVENTS</h1>
        <h2>Upcoming Events in our college</h2>
      </div>
      <!--<div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="assets/img/agriculture.png" class="img-fluid animated" alt="" width="500">
      </div>-->
    </div>
  </div>

  </section>
<!-- End Hero -->


<div class="section-title" >
          <h2>Upcoming Events</h2>
        </div>

<!-- ======= Main Section ======= -->
  <main id="main" style=" padding:30px; background-image: url(assets/img/bg.jpg); background-repeat: no-repeat; background-size: cover; background-position: center;position: relative;">


        <?php

$sql = "SELECT * FROM events, hosts WHERE events.HostId= hosts.HostId ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) { 
    date_default_timezone_set("Asia/Bangkok"); 
    $eventDate = date_create($row["Date"]);
    $currentDate =date_create(date('Y-m-d')) ;
    $diff = date_diff($currentDate,$eventDate);
    $check= $diff->format("%R%a");
      if ($check>0) {

    ?>

    <div  class="col-md-12"  >
      <div class="container myClass1" style="margin-top: 20px;margin-bottom:20px;" id="content_loader">
        <div class="card shadow p-3 mb-5  rounded" styles="background-color: #47b2e4;">
          <h4 class="card-title"><b>
              <?php echo $row["EventName"] ?>
          </b></h4>
          <br>
          
          <div class="card-body text-center">
            <div class="col">
              Host : <?php echo $row["HostName"] ?> <br /> 
              Date : <?php echo $row["Date"] ?> <br /> 
              Level : <?php echo $row["Level"] ?> <br /> 
            </div>
            
          </div>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=<?php echo "#event".$row["EventId"] ?> style="background-color: #37517e; width: 30%; align-self: center; ">
            View More
          </button>

          <!-- Modal -->
          <div class="modal fade" id=<?php echo "event".$row["EventId"] ?> data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="padding-top: 30px;">
            <div class="modal-dialog modal-dialog-scrollable modal-lg"  >
              <div class="modal-content" style=" margin-top:0; background-image: url(assets/img/eventdesc.jpeg); background-repeat: no-repeat; background-size: cover; background-position: center;position: relative;">
                <div class="modal-header" style="background-color: #37517e; ">
                  <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">
                    <?php echo $row["EventName"] ?> <br />
                    </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff;"></button>
                </div>
                <div class="modal-body">
                  <div class="grant-items" style="">
                  <ul style="list-style-type:none;">
                    
                    <strong>Date :</strong>
                    <li>
                      <p align="justify" >
                        <?php echo $row["Date"] ?> <br />
                      </p>
                    </li>
                    <strong>Description :</strong>
                    <li>
                      <p align="justify" style="max-height: 200; overflow-y: scroll;">
                        <?php echo $row["Description"] ?> <br />
                      </p>
                    </li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                      $sql = "SELECT * FROM participation, student_details WHERE participation.EventId= '".$row['EventId']."' and participation.StudentId = student_details.StudentId";
                      $participants = $conn->query($sql);
                        if (($_SESSION['type']=='faculty')||($_SESSION['type']=='host') ) {
                            if ($participants->num_rows > 0) {
                              // output data of each row
                              ?>
                              <strong>Participants :</strong>
                              <table border='1' style="width:100%">
                              <tr>  <th styles="padding: 15px;">name</th> <th styles="padding: 15px;">Email Id</th> <th styles="padding: 15px;">Class</th>
                              </tr>
                              <?php 
                              while($srow = $participants->fetch_assoc()) {?>
                                <tr> <td styles="padding: 15px;"> <?php echo $srow["FullName"]?> </td> 
                                    <td styles="padding: 15px;"> <?php echo $srow["EmailId"]?> </td>
                                    <td styles="padding: 15px;"> <?php echo $srow["Class"]?></td></tr>
                              <?php }
                            } else {
                              echo "0 participants";
                            }
                            echo "</table>";
                        }
                        else { ?>
                          <strong>Participants :</strong>
                          <li>
                            <p align="justify" >
                              <?php echo $participants->num_rows?> <br />
                            </p>
                          </li> <?php
                        } 
                    } 
                    ?> 
                    <?php if(isset($_SESSION['user_id'])) { 
                       if ($_SESSION['type']=='student'){
                          if($r= mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM participation WHERE Eventid = '" . $row['EventId']. "' and StudentId = '" .$_SESSION['user_id']. "'"))) { ?>
                          
                            <input type="submit" class="button" value="Registered !" style="background-color: #fff; width: 30%; align-self: center; "/> 
                          
                          <?php } 
                          else { ?>
                            <form method="post" action=<?php $eventId = $row['EventId'];?> >
                              <input type="submit" name="register" class="button" value="Register"  style="background-color: #37517e; width: 30%; align-self: center; "/> 
                            </form>
                          <?php }
                       } 
                       else {

                       }
                    } 
                    else { ?>
                      <a href="login.php"> Register</a>
                    <?php } ?>
                  </ul>
                </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
  echo "</table>";
} else {
  echo "0 results ";
}
$conn->close();

?>



  </main>
<!-- End #main -->

<!-- ======= Footer ======= -->
  
  <footer id="footer">

    
    
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
       
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>