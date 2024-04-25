<?php

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'course_registration');

// Check if the 'student_id' parameter is set
if (isset($_GET['stID'])) {
    $stID = $_GET['stID'];

    // Prepare the SQL DELETE query
    $delete_sql = "DELETE FROM students_table WHERE StudentId = '$stID'";

    // Execute the query
    if ($con->query($delete_sql) === TRUE) {
        header("Location:index.php?msg=Data deleted successfully");
        
    } else {
        echo "Error deleting record: " . $con->error;
    }
} else {
    echo "Student ID not provided.";
}

mysqli_close($con);
?>
