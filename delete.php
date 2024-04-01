<?php
$con=mysqli_connect('localhost','root','','course_registration');

if(isset($_post['delete_student'])){
    $stID=$_post['StudentId'];

    $sqlDeleteStudent="DELETE FROM students_table WHERE StudentId='$stID'";

    if(mysqli_query($con,$sqlDeleteStudent)){
        echo"record deleted successfully";
    }else{
        echo"error deleting record".mysqli_error($con);
    }
}
$sqlDeleteStudent="SELECT * FROM students_table";
$sqldata1=$con->query($sqlDeleteStudent);
$row=mysqli_fetch_assoc($sqldata1);

mysqli_close($con);
?>