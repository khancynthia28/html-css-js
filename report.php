<?php

$showTranscript=false;
$showCourse=false;
$showAll=false;
require_once "config.php";

if(isset($_POST['transcript_btn']))
{
    $showTranscript=true;
    $showCourse=false;
    $showAll=false;
    $student_id = $_POST['student_id'];

    if(empty(trim($_POST["student_id"]))){
            $student_name = "Please enter a student id";
    }

    else{

          /* create a prepared statement */
            if ($stmt = mysqli_prepare($link, "SELECT CONCAT(first_name,' ', last_name) as name from tblStudents WHERE student_id = '$student_id';")) {

            /* execute query */
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_num_rows($stmt)== 0){
                $student_name = "No records found";
            }
            
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $student_name);

            /* fetch value */
            mysqli_stmt_fetch($stmt);
            
            /* close statement */
            mysqli_stmt_close($stmt);
            
        }
    }
            $sql = "SELECT 'Course' AS course, 'Grade' AS mark FROM tblStudents LIMIT 1;";
            $student_result = filterTable($sql);
            
            $query = "SELECT CONCAT(c.first_name, ' ', c.last_name) as name, b.module_name as course, a.mark
                FROM tblMarks a 
                INNER JOIN tblModules b
                ON a.module_code = b.module_code
                INNER JOIN tblStudents c
                ON a.student_id = c.student_id
                WHERE a.student_id = '$student_id';";
          
            $student_search = filterTable($query);

}

else if(isset($_POST['course_btn']))
{
    $showTranscript=false;
    $showCourse=true;
    $showAll=false;
    $course_id = $_POST['course_id'];

    if(empty(trim($_POST["course_id"]))){
 
            $course_name = "Please enter a course id";
    }

    else{

          /* create a prepared statement */
            if ($stmt = mysqli_prepare($link, "SELECT module_name as name from tblModules WHERE module_code = '$course_id';")) {

            /* execute query */
            mysqli_stmt_execute($stmt);
            
             if(mysqli_stmt_num_rows($stmt)== 0){
                $course_name = "No records found";
            }
            
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $course_name);

            /* fetch value */
            mysqli_stmt_fetch($stmt);
            
            /* close statement */
            mysqli_stmt_close($stmt);
            
            }
    }
            $sql = "SELECT 'Student' AS name, 'Grade' AS mark FROM tblStudents LIMIT 1;";
            $course_result = filterTable($sql);
            
            $query = "SELECT CONCAT(c.first_name, ' ', c.last_name) as name, b.module_name as course, a.mark
                FROM tblMarks a 
                INNER JOIN tblModules b
                ON a.module_code = b.module_code
                INNER JOIN tblStudents c
                ON a.student_id = c.student_id
                WHERE a.module_code = '$course_id';";
          
            $search_result = filterTable($query);
}

else if(isset($_POST['all_btn']))
{
    $showTranscript=false;
    $showCourse=false;
    $showAll=true;
            
            $sql = "SELECT 'Student-Name' AS student_name, 'School-Year' AS school_year, 'Courses' AS courses, 'Grades' AS grades FROM tblStudents LIMIT 1;";
            $all_result = filterTable($sql);
            
            $query = "SELECT Student_Names AS student_name, School_Year AS school_year, Courses AS courses, Grades AS grades FROM tblRecords;";
          
            $all_search = filterTable($query);
}

else{
    $query = "SELECT * FROM `tblModules` WHERE module_code = 'CM0009'";
    $search_result = filterTable($query);
    $student_search = filterTable($query);
    $student_result = filterTable($query);
    $course_result = filterTable($query);
    $all_result = filterTable($query);
    $all_search = filterTable($query);
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
	<title>Report</title>
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

	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/page-bg/4.jpg" style="height:200px; position: relative;">
		<div class="container" style="position: absolute; top: -150px; left: 20px;">
			<div class="site-breadcrumb">
				<a href="welcome.php">Home</a>
				<span>Contact</span>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="search-warp" style="height:60px">
				<div class="section-title text-white">
					<h2><span>Select Report Criteria</span></h2>
				</div>
				<div class="row">
					<div class="col-lg-5 offset-sm-1 text-white">
					    
						<!-- search form -->
						<form class="course-search-form" action="report.php" method="post">
							<input id="transcript" type="radio" name="transcript-radio" value="transcript"> Student Transcript&nbsp&nbsp&nbsp&nbsp
							<input id="course" type="radio" name="course-radio" value="course"> Course Record &nbsp&nbsp&nbsp&nbsp
							<input id="all" type="radio" name="all-radio" value="all"> All
							
							<div id="student-id" style="display: none;">
								<input type="text" name="student_id" placeholder="Student ID" style="width:300px; height:50px; position:absolute; top:-20px; right:-250px">
								<input type="submit" class="site-btn btn-dark" name="transcript_btn" style="height:50px; position:absolute; top:-20px; right:-450px">
							</div>
							
							<div id="course-id" style="display: none;">
								<input type="text" name="course_id" placeholder="Course ID" style="width:300px; height:50px; position:absolute; top:-20px; right:-250px">
								<input type="submit" class="site-btn btn-dark" name="course_btn" style="height:50px; position:absolute; top:-20px; right:-450px">
							</div>
							<div id="all-records" style="display: none;">
								<input type="submit" class="site-btn btn-dark" name="all_btn" style="height:50px; position:absolute; top:-20px; right:-450px">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- search section end -->
	
	<!-- Report section begin -->
	<div id="course-view" class="container" <?php if ($showCourse===false){?>style="display:none"<?php } ?>>
	    <div class="section-title">
	        <h3><span><?php echo htmlspecialchars($course_name); ?></span></h3>
	    </div>
	    <table style="text-align:center; width:70%;">
	     <?php while($row = mysqli_fetch_array($course_result)):?>
             <tr>
                 <th><?php echo $row['name'];?></th>
                 <th><?php echo $row['mark'];?></th>
             </tr>
            <?php endwhile;?>
	        <?php while($row = mysqli_fetch_array($search_result)):?>
	        <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['mark'];?></td>
                </tr>
            <?php endwhile;?>
	    </table>
	</div>
	
	<div id="transcript-view" class="container" <?php if ($showTranscript===false){?>style="display:none"<?php } ?>>
	    <div class="section-title">
	        <h3><span><?php echo htmlspecialchars($student_name); ?></span></h3>
	    </div>
	    <table style="text-align:center; width:70%;">
	     <?php while($row = mysqli_fetch_array($student_result)):?>
             <tr>
                 <th><?php echo $row['course'];?></th>
                 <th><?php echo $row['mark'];?></th>
             </tr>
            <?php endwhile;?>
	        <?php while($row = mysqli_fetch_array($student_search)):?>
	        <tr>
                    <td><?php echo $row['course'];?></td>
                    <td><?php echo $row['mark'];?></td>
                </tr>
            <?php endwhile;?>
	    </table>
	</div>
	
	<div id="all-view" class="container" <?php if ($showAll===false){?>style="display:none"<?php } ?>>

	    <table style="text-align:center; width:70%;">
	     <?php while($row = mysqli_fetch_array($all_result)):?>
             <tr>
                 <th><?php echo $row['student_name'];?></th>
                 <th><?php echo $row['school_year'];?></th>
                 <th><?php echo $row['courses'];?></th>
                 <th><?php echo $row['grades'];?></th>
             </tr>
            <?php endwhile;?>
	        <?php while($row = mysqli_fetch_array($all_search)):?>
	        <tr>
                 <td><?php echo $row['student_name'];?></td>
                 <td><?php echo $row['school_year'];?></td>
                 <td><?php echo $row['courses'];?></td>
                 <td><?php echo $row['grades'];?></td>
            </tr>
            <?php endwhile;?>
	    </table>
	</div>

    <!-- report section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>


	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWTIlluowDL-X4HbYQt3aDw_oi2JP0Krc&sensor=false"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script src="js/map.js"></script>

	<script type="text/javascript">
  		$(document).ready(function() {
   			$('input[type="radio"]').click(function() {
       			if($(this).attr('id') == 'transcript') {
       				$('#course-id').hide();
       				$('#all-records').hide();
            		$('#student-id').show(); 
       			}

               else if($(this).attr('id') == 'course') {
               		$('#student-id').hide();
               		$('#all-records').hide();
            		$('#course-id').show();
       			}
       			
       		   else if($(this).attr('id') == 'all') {
               		$('#student-id').hide();
            		$('#course-id').hide();
            	    $('#all-records').show();
       			}
   			});
		});
	</script>
</body>
</html>