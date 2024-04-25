<?php
// Connect to the database
$con = mysqli_connect('localhost', 'root', '', 'course_registration');

// Check if the delete button is clicked
if (isset($_POST['delete_student'])) {
    // Get the ID of the record to be deleted
    $record_id = $_POST['record_id'];

    // Prepare the delete query
    $sql = "DELETE FROM students_table WHERE StudentId = '$record_id'";

    // Execute the delete query
    if (mysqli_query($con, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>