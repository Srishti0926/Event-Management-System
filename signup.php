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
if(isset($_SESSION['username'])) {
	header("Location: dashboard.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);    
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
    $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student_details"));
    $studentid= $count+1;
    switch ($department) {
        case 'CMPN': $deptid=1;
                        break;
                        
        case 'IT': $deptid=2;
                        break;
        
        case 'EXTC': $deptid=4;
                        break;
                        
        case 'ETRX': $deptid=13;
                        break;
        
        case 'INST': $deptid=5;
                        break;
                        
        case 'AIDS': $deptid=6;
                        break;
    }
        
                        
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO `student_details` (`StudentId`, `FullName`, `EmailId`, `DeptId`, `Class`, `PhoneNo`, `Password`) VALUES( '".$studentid."',  '".$name."' , '".$email."' , '".$deptid."' , '".$class."' ,  '".$phoneno."' , '".$password ."')")) {
			$success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
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

<body>

<!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center" >
      
      <h1 class="logo mr-auto"><a href="index.html" style="text-decoration: none;">VESIT EVENTS DASHBOARD</a></h1>
    
   
          
      <nav class="nav-menu d-none d-lg-block" style="float: right; ">
        <ul style="align-items: center;">
        <li ><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
          <li><a href="reports.php" style="text-decoration: none;">Reports</a></li>
          <li><a href="login.php" style="text-decoration: none;">Login</a></li>
          <li ><a href="" style="text-decoration: none;">Sign Up</a></li>
          
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
  <main id="main" style=" background-image: url(assets/img/form_bg1.jpg); background-repeat: no-repeat; background-size: cover; background-position: center;position: relative;">

  <div class="container">	
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
    <strong><h3> Signup </h3></strong>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Enter Full Name" required value="" class="form-control" />
					</div>					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="" class="form-control" />
					</div>
                    <div class="form-group">
						<label for="name">Department</label>
						<input type="text" name="department" placeholder="Department" required value="" class="form-control" />
					</div>
                    <div class="form-group">
						<label for="name">Class</label>
						<input type="text" name="class" placeholder="Class" required value="" class="form-control" />
					</div>
                    <div class="form-group">
						<label for="name">Phone No</label>
						<input type="text" name="phoneno" placeholder="Phone Number" required value="" class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
					</div>
					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
            
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>	
</div>

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