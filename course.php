<?php

require_once "config.php";
if(isset($_POST['search']))
{
    $courseName = $_POST['courseName'];
    $courseId = $_POST['courseId'];
    // search in all table columns
    // using concat mysql function
    if(empty(trim($_POST["courseId"]))){
        if(empty(trim($_POST["courseName"]))){
            $query = "SELECT * FROM tblModules WHERE module_code = 'error - 01 -'";
            $search_result = filterTable($query);
        }
        else{
            $query = "SELECT * FROM tblModules WHERE CONCAT(`module_code`, `module_name`) LIKE '%".$courseName."%'";
            if($stmt = mysqli_prepare($link, $query)){
                if(mysqli_stmt_execute($stmt)){
                   /* if(mysqli_stmt_num_rows($stmt)== 0){
                        $search_result = filterTable("SELECT * FROM tblModules WHERE module_code = 'error - 02 -'");
                    }
                    else {*/
                        $search_result = filterTable($query);
                 //   }
                }
            }
        }
    }
    else{
        $query = "SELECT * FROM tblModules WHERE CONCAT(`module_code`, `module_name`) LIKE '%".$courseId."%'";
        if($stmt = mysqli_prepare($link, $query)){
                if(mysqli_stmt_execute($stmt)){
                  /*  if(mysqli_stmt_num_rows($stmt)== 0){
                        $search_result = filterTable("SELECT * FROM tblModules WHERE module_code = 'error - 02 -'");
                    }
                    else {*/
                        $search_result = filterTable($query);
                 //   }
                }
        }
    }
    
}

else{
    $query = "SELECT * FROM `tblModules` WHERE module_code = 'CM0009'";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("192.185.4.123", "cynthia_khan", "P@ssw0rd!", "cynthia_DB_School_Records");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>WebUni - Education Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="WebUni Education Template">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

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
						<h3 style="color:#C0C0C0;">Sierra Leone Grammar School</h3>
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<!--a href="" class="site-btn header-btn">Login</a-->
					<nav class="main-menu">
						<ul>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/page-bg/1.jpg">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="welcome.php">Home</a>
				<span>Courses</span>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="search-warp">
				<div class="section-title text-white">
					<h2><span>Search your course</span></h2>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<!-- search form -->
						<form class="course-search-form" action="course.php" method="post">
							<input type="text" name="courseId" placeholder="Course ID">
							<input type="text" class="last-m" name="courseName" placeholder="Course Name">
							<input type="submit" class="site-btn btn-dark" name="search" value="Search Course">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- search section end -->
    <!-- query result section begin -->
    <div style="text-align:center;">
        <span><br><br>
            <?php while($row = mysqli_fetch_array($search_result)):?>
                <div>Course ID : <?php echo $row['module_code'];?></td>
                <div>Course Name : <?php echo $row['module_name'];?></td>
            <?php endwhile;?>
        <span>
    </div>

	<!-- course section -->
	<section class="course-section spad pb-0">
		<div class="course-warp">
			<ul class="course-filter controls">
				<li class="control active" data-filter="all">All</li>
				<li class="control" data-filter=".math">Math</li>
				<li class="control" data-filter=".language">Language</li>
				<li class="control" data-filter=".science">Science</li>
				<li class="control" data-filter=".arts">Arts</li>
			</ul>                                       
			<div class="row course-items-area">
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 math">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/8.jpg">
							<div class="price">Algebra</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0001</h5>
								<p>Algebra - letters and symbols used to represent numbers.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 language">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/2.jpg">
							<div class="price">English</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0002</h5>
								<p>English - the language of England, widely used in many varieties.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 science">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/3.jpg">
							<div class="price">Physics</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0003</h5>
								<p>Physics - the physical properties and phenomena of something.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 arts">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/4.jpg">
							<div class="price">Music</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0004</h5>
								<p>Music - the written or printed signs representing vocal or sound.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 math">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/5.jpg">
							<div class="price">Trigonometry</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0005</h5>
								<p>Trigonometry - relations of the sides and angles of triangles.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 language">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/6.jpg">
							<div class="price">French</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0006</h5>
								<p>French - relating to France or its people or language.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 science">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/7.jpg">
							<div class="price">Chemistry</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0007</h5>
								<p>Chemistry - identification of the substances of which matter is composed</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 arts">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="img/courses/1.jpg">
							<div class="price">Painting</div>
						</div>
						<div class="course-info">
							<div class="course-text">
								<h5>CM0008</h5>
								<p>Painting - the process or art of using paint, in a picture, as a protective coating.</p>
								<div class="students">120 Students</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- course section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>