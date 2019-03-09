<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SierraLeone - Welcome</title>
	<meta charset="UTF-8">
	<meta name="description" content="Sierra Leone Education Template">
	<meta name="keywords" content="sierra leone, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/logo.jpg" rel=""/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-sm-2">
					<div class="site-logo">
						<img src="img/logo.jpg" alt="">
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<nav class="main-menu">
						<ul>
							<li><a href="welcome.php">Home</a></li>
							<li><a href="#">Profile</a></li>
							<li><a href="course.php">My Courses</a></li>
							<li><a href="reset-password.php">Reset Password</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->

        <!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/page-bg/5.jpg">
		<div class="container">
                        <div class="col-sm-1 col-sm-1"><p></p></div>
			<div class="site-breadcrumb">
				<a href="welcome.php">Home</a>
				<span>Welcome</span>
			</div>
                        <div class="col-lg-9 col-md-9" text-align="center">
        			<h1><font color="white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your Dashboard.</font></h1>
    			</div>
		</div>
	</div>
	<!-- Page info end -->
	
	<!-- Page -->
	<section class="elements-page spad pb-0">
		<div class="container">
			<div class="element">
				<!-- h2 class="e-title">Buttons</h2 -->
				<a href="student.php" class="site-btn mr-3 mb-3 mb-md-0">Register Student</a>
				<a href="entergrade.php" class="site-btn btn-dark mr-3 mb-3 mb-md-0">Enter Grades</a>
				<a href="report.php" class="site-btn btn-fade">Reports</a>
			</div>
        		<!-- Element -->
			<div class="element">
				<h2 class="e-title">Progress</h2>
				<div class="row">
					<div class="col-lg-3 col-sm-6 cp-item">
						<div class="circle-progress" data-cpid="id-1" data-cpvalue="75" data-cpcolor="#e82154" data-cptitle="New Students"></div>
					</div>
					<div class="col-lg-3 col-sm-6 cp-item">
						<div class="circle-progress" data-cpid="id-2" data-cpvalue="83" data-cpcolor="#e82154" data-cptitle="New Teachers"></div>
					</div>
					<div class="col-lg-3 col-sm-6 cp-item">
						<div class="circle-progress" data-cpid="id-3" data-cpvalue="25" data-cpcolor="#e82154" data-cptitle="Activities"></div>
					</div>
					<div class="col-lg-3 col-sm-6 cp-item">
						<div class="circle-progress" data-cpid="id-4" data-cpvalue="95" data-cpcolor="#e82154" data-cptitle="Ranking"></div>
					</div>
				</div>
			</div>
			<!-- Element -->
			<div class="element">
				<h2 class="e-title">Milestones</h2>
				<div class="row">
					<div class="col-lg-3 col-sm-6 fact-item">
						<h2>1200</h2>
						<p>New Students</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<h2>15k</h2>
						<p>Honor Students</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<h2>234</h2>
						<p>Accomplished Teachers</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<h2>3792</h2>
						<p>Successful Projects</p>
					</div>
				</div>
			</div>
			<!-- Element -->
			<div class="element">
				<h2 class="e-title">Goals</h2>
				<div class="row">
					<div class="col-lg-4 col-md-6 icon-box">
						<h5><span>01.</span>Teachers Training</h5>
						<p>Description goes here.</p>
					</div>
					<div class="col-lg-4 col-md-6 icon-box">
						<h5><span>02.</span>Student Performance</h5>
						<p>Performance stats goes here. </p>
					</div>
					<div class="col-lg-4 col-md-6 icon-box">
						<h5><span>03.</span>Sporting Facilities</h5>
						<p>Facilities Details go here</p>. </p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</html>
