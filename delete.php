<?php
/* Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'course_registration');


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to delete a record
$sql ="DELETE FROM  students_table WHERE  StudentId='StudentId'";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

/*include "db.php";

$StudentId=$_GET['StudentId'];

$sql="DELETE FROM from students_table WHERE StudentId= $StudentId"
$p=mysqli_query($con,$sql);

if($p){
    header("Location:Details.php?msg=Data deleted successfully");
}else{
    echo"Failed:".mysqli_error($con);
    header("Location:records.php?msg=Data deleted faild");
}*/
?>