<?php
require_once "config.php";

$sql = "SELECT DISTINCT module_code, module_name from tblModules ORDER BY module_code;";
$result = filterTable($sql);
$header_sql = "SELECT 'ID' AS student_id, 'Name' AS student_name;";
$header = filterTable($header_sql);
$query = "SELECT student_id, CONCAT(first_name, ' ', last_name) as student_name from tblStudents";
$student_search = filterTable($query);

function filterTable($query)
{
    $connect = mysqli_connect("192.185.4.123", "cynthia_khan", "P@ssw0rd!", "cynthia_DB_School_Records");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

if(isset($_POST['submit']))
{
    $course_id = $_POST['course_id'];
    $period = $_POST['period'];
    
    $filter = filterTable("SELECT student_id from tblStudents");
    
    while ($row = mysqli_fetch_assoc($filter)) { 
     $rows[] = $row; 
    } 
    
    $grade = $_POST['enter_grade'];
    
    for($i=0;$i<count($rows);$i++) { 
        $student_id = $rows[$i]['student_id'];
        $mark = $grade[$i];
        
        $query = "INSERT INTO tblGrades(student_id, module_code, mark, period) VALUES('$student_id','$course_id','$mark','$period');";
        $insert = filterTable($query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Enter Grades</title>
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
			<div>
			    <p><h3 style="color:#C0C0C0;">Sierra Leone Grammar School</h3></p>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- Enter Grades section begin -->
	<div>
	    <center><h2>Enter Grades</h2></center>
	</div>
	<br/>
	<form action="entergrade.php" method="post">
	    <!--course id and period dropdown-->
	    <center>
	        <select required name="course_id" style="width:150px; height:40px;">
				<?php while($row = mysqli_fetch_array($result)):?>
				    <option value="<? echo $row['module_code']; ?>" 
				    <? if($row['module_code']==$select){ echo "selected"; } ?>><? echo $row['module_name']; ?></option>
                <?php endwhile;?>
			</select>&nbsp&nbsp
			<select required name="period" style="width:150px; height:40px;">
                <option value=<? echo date("M-Y", strtotime('-2 month'));?>><?php echo date("M-Y", strtotime('-2 month'));?>
                </option>
                <option value=<? echo date("M-Y", strtotime('-1 month'));?>><?php echo date("M-Y", strtotime('-1 month'));?>
                </option>
                <option value=<? echo date('M Y'); ?>><?php echo date('M Y'); ?>
                </option>
                <option value=<? echo date("M-Y", strtotime('1 month'));?>><?php echo date("M-Y", strtotime('1 month'));?></option>
            </select>
	    </center>
	    <br/>
	    <center>
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
            <?php endwhile;?>
            <tr><td><p></p></td><td><p></p></td><td><p></p></td></tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" class="site-btn mr-3 mb-3 mb-md-0" name="submit" style="height:40px; width:80px; cellspacing:10px;"></td>
            </tr>
	    </table>
	    </center>
	</form>
    <!-- Enter Grades section end -->

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

</body>
</html>