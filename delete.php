<?php

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'course_registration');

// Check if the 'student_id' parameter is set
if (isset($_GET['stID'])) {
    $stID = $_GET['stID'];

    // Prepare the SQL DELETE query
    $delete_sql = $con->prepare("UPDATE students_table SET FirstName=null,LastName = null,DateOfBirth = null,Gender = null,Email = null,Phone = null,
    EmergencyContactName = null,EmergencyContactPhone = null,Address=null,  WHERE id = ?");
    $delete_sql->bind_param("s",$stID);

    // Execute the query
    if ($delete_sql->execute()) {
        header("Location:details.php?msg=Data deleted successfully");
        
    } else {
        echo "Error deleting record: " . $delete_sql->error;
    }
    
    $delete_sql->close();

} else {
    echo "Student ID not provided.";
}


if(isset($_GET[''])){
    
}

mysqli_close($con);
?>
