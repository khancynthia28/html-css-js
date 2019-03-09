<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM tblUsers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SierraLeone - Education Template</title>
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
				<div class="col-lg-3 col-md-3">
					<div class="site-logo">
						<img src="img/logo.jpg" alt="">
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<a href="register.php"><input type=button class="site-btn header-btn" value="Sign Up"></a>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img/bg.jpg">
		<div class="container">
			<div class="hero-text text-white">
				<h2>Best School in Sierra Leone</h2>
				<h3>Login</h3>
			   <p></p>
			<!-- Scroll -->
			    <marquee scrollamount="3"
			        behavior="scroll" direction="left">
			        *** &nbsp "Technology hub is proving to be a hit in Sierra Leone" - intelligentcio   &nbsp 
			        *** &nbsp "A (SENSI)BLE SOLUTION FOR SIERRA LEONE" - sensi-sl.org  &nbsp
			        *** &nbsp "Salone. Na We All Yone. Leh We Mek Am" - dsti.gov  &nbsp 
			        *** &nbsp "President Bio Appoints Chief Innovation Officer, Directorate of Science, Technology and Innovation" - statehouse.gov &nbsp
			        *** &nbsp "Sierra Leone News: Science and technology provides solutions to development challenges" - awoko.org &nbsp
			        *** &nbsp "Sierra Leone launches free school education" - thesierraleonetelegraph.com &nbsp
			        *** &nbsp "Back to School: A Life-Changing Education in Sierra Leone" - worldofchildren.org &nbsp
			        *** &nbsp "Sierra Leone’s free quality education programme – how prepared are schools?" - thesierraleonetelegraph.com &nbsp ***
			    </marquee>
			</div>
			<form class="intro-newslatter" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                	<div>
                                                		<label><font color="white">Username</font></label>
							</div>
							<div>
								<input type="text" placeholder="username" name="username" value="">
								<span class="help-block"><?php echo $username_err; ?></span>
							</div>
						</div>
						<br/><br/><br/>  
            					<div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<div>
                                                		<label><font color="white">Password</font></label>
							</div>
							<div>
                						<input class="nav-link active" size="52" type="password" placeholder="password" name="password">
                						<span class="help-block"><?php echo $password_err; ?></span>
							</div>
            					</div><br/>
						<div>
                                                        <div>
                						<input type="submit" class="site-btn" value="Login">
							</div>
            					</div>
            					<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
			</form>
		</div>
	</section>
	<!-- Hero section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</html>
