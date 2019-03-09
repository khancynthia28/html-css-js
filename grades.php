<?php

require_once "config.php";

$sql = "SELECT DISTINCT module_code from tblMarks ORDER BY module_code;";
$result = filterTable($sql);

if(isset($_POST['search']))
{
  $course_id = $_POST['course_id'];
  $period = $_POST['period'];
    
    if(empty(trim($_POST['course_id'])))
    {
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
       
       $header_sql = "SELECT 'ID' AS student_id, 'Name' AS student_name;";
       $header = filterTable($header_sql);
       
       $query = "SELECT student_id, CONCAT(first_name, ' ', last_name) as student_name from tblStudents";
          
       $student_search = filterTable($query);

}

if(isset($_POST['submit'])){
    
    $query = "SELECT student_id, CONCAT(first_name, ' ', last_name) as student_name from tblStudents";
    $student_search = filterTable($query);
       
    $filter = filterTable("SELECT student_id from tblStudents");
    //$student_id= mysqli_fetch_assoc($filter);
    
    while ($row = mysqli_fetch_assoc($filter)) { 
     $rows[] = $row; 
    } 
    
    $grade = $_POST['enter_grade'];
    $course_val = $course_id;
    $period_val = $period;

    $header_sql = "SELECT 'ID' AS student_id, 'Name' AS student_name;";
    $header = filterTable($header_sql);
    
    for($i=0;$i<count($rows);$i++) { 
        
        $student_id = $rows[$i]['student_id'];
        $mark = $grade[$i];
      //  $query = "SELECT period FROM tblGrades WHERE module_code = '$value'; LIMIT 1";
        
      //  $resultSet = filterTable($query);
        
      //  if($resultSet_num_rows == 0){
            //Perform insert
            $query = "INSERT INTO tblGrades(student_id, module_code, mark, period) VALUES('
            $student_id
            ','
            $course_val
            ','
            $mark
            ','
            $period_val
            ')
            ";
            
            $insert = filterTable($query);
     /*   }
        
        else{
            $course_name = "This record already exists";
        }*/
    }
}
else{
    $query = "SELECT * FROM `tblModules` WHERE module_code = 'CM0000'";
    $student_search = filterTable($query);
    $header = filterTable($query);
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
				<span>Grades</span>
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
						<form class="course-search-form" action="grades.php" method="post">

							<select required name="course_id" style="width:150px; height:55px;">
							    <?php while($row = mysqli_fetch_array($result)):?>
							    <option value="<? echo $row['module_code']; ?>" <? if($row['module_code']==$select){ echo "selected"; } ?>><? echo $row['module_code']; ?></option>
                                    <!--option value=<!--?php $row['module_code'];?>><!--?php echo $row['module_code'];?></option-->
                                <?php endwhile;?>
							</select>&nbsp&nbsp
							<select required name="period" style="width:150px; height:55px;">
                                <option value=<? echo date("M-Y", strtotime('-2 month'));?>><?php echo date("M-Y", strtotime('-2 month'));?></option>
                                <option value=<? echo date("M-Y", strtotime($mth . " last month"));?>><?php echo date("M-Y", strtotime($mth . " last month"));?></option>
                                <option value=<? echo date('M Y'); ?>><?php echo date('M Y'); ?></option>
                                <option value=<? echo date("M-Y", strtotime('1 month'));?>><?php echo date("M-Y", strtotime('1 month'));?></option>
                            </select>&nbsp&nbsp&nbsp&nbsp&nbsp
							<button name="search" class="site-btn btn-dark">Enter Grades</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- search section end -->

    	<div id="course-view" class="container">
	    <div class="section-title" style="height:40px;">
	        <h3><?php echo htmlspecialchars($course_name); ?></h3>
	    </div>
	    <form action="grades.php" method="post">
	    <table style="text-align:center; width:70%;">
	     <?php while($row = mysqli_fetch_array($header)):?>
             <tr>
                 <th><?php echo $row['student_id'];?></th>
                 <th><?php echo $row['student_name'];?></th>
             </tr>
            <?php endwhile;?>
	        <?php while($row = mysqli_fetch_array($student_search)):?>
	        <tr>
                    <td><?php echo $row['student_id'];?></td>
                    <td><?php echo $row['student_name'];?></td>
                    <td><input type="text" name="enter_grade[]" placeholder="Enter Grade"></td>
                </tr>
            <?php endwhile;?><br/><br/>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" class="site-btn mr-3 mb-3 mb-md-0" name="submit" style="height:40px; width:80px; cellspacing:10px;"></td>
            </tr>
	    </table>
	    </form>
	</div>


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>