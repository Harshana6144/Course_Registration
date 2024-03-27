<?php
$con=mysqli_connect('localhost','root','','course_registration');

if(isset($_post['delete_student'])){
    $recocord_id=$_post['StudentId'];

    $sql="DELETE FROM students_table WHERE StudentId='$StudentId'";

    if(mysqli_query($con,$sql)){
        echo"record deleted successfully";
    }else{
        echo"error deleting record".mysqli_error($con);
    }
}
mysqli_close($con);
?>