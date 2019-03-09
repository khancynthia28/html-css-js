<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$student_id = $first_name = $last_name = $dob = "";
$student_id_err = $first_name_err = $last_name_err = $dob_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate student id
    if(empty(trim($_POST["student_id"]))){
        $student_id_err = "Please enter a Student ID";
    } else{
        // Prepare a select statement
        $sql = "SELECT student_id FROM tblStudents WHERE student_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_studentid);
            
            // Set parameters
            $param_studentid = trim($_POST["student_id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $student_id_err = "This ID is already taken.";
                } else{
                    $student_id = trim($_POST["student_id"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate confirm first name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter a first name";     
    } else{
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter a last name";     
    } else{
        $last_name = trim($_POST["last_name"]);
    }

    // Validate dob
    if(empty(trim($_POST["dob"]))){
        $dob_err = "Please enter a date of birth";     
    } else{
        $dob = trim($_POST["dob"]);
    }
    
    // Check input errors before inserting in database
    if(empty($student_id_err) && empty($first_name_err) && empty($last_name_err) && empty($dob_err) && empty($course_id_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tblStudents (student_id, first_name, last_name, dob) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $param_student_id, $param_first_name, $param_last_name, $param_dob);
            
            // Set parameters
            $param_student_id = $student_id;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_dob = $dob;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Student Registeration</h2>
        <p>Please fill this form to create new student record</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($student_id_err)) ? 'has-error' : ''; ?>">
                <label>Student ID</label>
                <input type="text" name="student_id" class="form-control" value="<?php echo $student_id; ?>">
                <span class="help-block"><?php echo $student_id_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                <label>DOB</label>
                <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
                <span class="help-block"><?php echo $dob_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" onClick="welcome.php">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>