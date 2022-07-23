<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventmanagement";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
session_start();
if (isset($_SESSION['user_id'])) {
	header("Location: dashboard.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$result = mysqli_query($conn, "SELECT * FROM student_details WHERE EmailId = '" . $email. "' and Password = '" .$password. "'");
  if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['StudentId'];
		$_SESSION['username'] = $row['FullName'];
    $_SESSION['type'] = 'student';
		header("Location: dashboard.php");
	} 
  else if ($row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM faculty_details WHERE Email = '" . $email. "' and Password = '" .$password. "'"))) {
    $_SESSION['user_id'] = $row['FacultyId'];
    $_SESSION['username'] = $row['FullName'];
    $_SESSION['type'] = 'faculty';    
		header("Location: dashboard.php");
  }
  else if ($row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hosts WHERE HostEmail = '" . $email. "' and Password = '" .$password. "'"))) {
    $_SESSION['user_id'] = $row['HostId'];
    $_SESSION['username'] = $row['HostName'];
    $_SESSION['type'] = 'host';    
		header("Location: dashboard.php");
  }
  else {
		$error_message = "Incorrect Email or Password!!!";
	}
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

<body styles="margin:auto; ">

<!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center" >
      
      <h1 class="logo mr-auto"><a href="index.html" style="text-decoration: none;">VESIT EVENTS DASHBOARD</a></h1>
    
   
          
      <nav class="nav-menu d-none d-lg-block" style="float: right; ">
        <ul style="align-items: center;">
          <li ><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
          <li><a href="reports.php" style="text-decoration: none;">Reports</a></li>
          <li><a href="" style="text-decoration: none;">Login</a></li>
          <li ><a href="signup.php" style="text-decoration: none;">Sign Up</a></li>
          
        </ul>

      </nav><!-- .nav-menu -->

  
    </div>
  </header>
<!-- End Header -->

<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height: 50px;">
  </section>
<!-- End Hero -->

<!-- ======= Main Section ======= -->
  <main id="main" style=" height:800px; background-image: url(assets/img/form_bg1.jpg); background-repeat: no-repeat; background-size: cover; background-position: center;position: relative;">

  <div class="container" styles="margin:auto; align-content: center; margin-bottom: 200px;">		
	<div class="row" styles="margin:auto; align-content: center;">
		<div class="col-md-4 col-md-offset-4 well" styles="margin:auto; align-self: center;">
    <strong><h3> Login </h3></strong>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Your Email" required class="form-control" />
					</div>	
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password" required class="form-control" />
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		New User? <a href="register.php">Sign Up Here</a>
		</div>
	</div>	
</div>
  
  </main>
<!-- End #main -->

<!-- ======= Footer ======= -->
  
  <footer id="footer" styles="position: absolute; bottom: 0; margin-top:200;">

    
    
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