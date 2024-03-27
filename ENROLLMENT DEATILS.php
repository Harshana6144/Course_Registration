<?php
require('./db.php');
session_start(); 

if (isset($_SESSION['course_id']) && !empty($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
} else {
    $course_id = "No Course ID provided" ;
}

$localcourse_id = $course_id;
//$Enrollment_No = '';

if(isset($_POST['submit'])){
    $course_id = $_POST['course_id'];
    $Enrollment_No = $_POST['Enrollment_No'];
    $EN_dob = $_POST['EN_dob'];
    $Semester = $_POST['Semester'];
    $stetus = isset($_POST['stetus']) ? $_POST['stetus'] : '';

    if(!empty($Enrollment_No) && !empty($EN_dob) && !empty($stetus)&& !empty($Semester))
    {
        $checkEnrollment_No = crud::conect()->prepare('SELECT COUNT(*) FROM enrollments_table WHERE  EnrollmentID = :EnrollmentID');
        $checkEnrollment_No->bindValue(':EnrollmentID', $Enrollment_No);
        $checkEnrollment_No->execute();
        $EnrollmentIDExists = $checkEnrollment_No->fetchColumn();

        if($EnrollmentIDExists > 0)
        {
            echo "<script type='text/javascript'> alert('Data already exists.')</script>";
        } else {
            $p = crud::conect()->prepare('INSERT INTO enrollments_table(EnrollmentID,Semester,CourseID,EnrollmentDate,Status) VALUES(:A,:S,:CD, :B, :C)');


            $p->bindValue(':A', $Enrollment_No);
            $p->bindValue(':S', $Semester);
            $p->bindValue(':CD',$course_id);
            $p->bindValue(':B', $EN_dob);
            $p->bindValue(':C', $stetus);
            $p->execute();

            //header("Location:DEPARTMENT DEATILS.php");
           // exit();
            echo "<script type='text/javascript'> alert('Successfully Saved')</script>"; 
        }
    } else {
        echo "<script type='text/javascript'> alert('Enter valid Information')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/ENROLL.css">
    <style>

.rounded-div form select{
    max-width: 485px;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;

}

.rounded-div .inputBox1 label {
    display: inline-block;
    margin-right: 20px;
    color: white;
}

.rounded-div form label{
    display: block;
    margin-bottom: 10px;
    font-size: 1.2em;
    color: #8f8f8f;
}



</style>
</head>
<body>
    <div class="rounded-div">
        <span class="borderAAA"></span>
        <form action="" method="post" autocomplete="off">
            
        <h2>ENROLLMENT DEATILS</h2>
            <br><br>


            <label  for="Semester">Select Your semester</label>
            <select name="Semester" id="Semester" required>
                <option value="" >Semester</option>
                <option value="Semester 1"> Semester 1 </option>
                <option value="Semester 2">Semester 2</option>
                <option value="Semester 3">Semester 3</option>
                <option value="Semester 4">Semester 4</option>
                
            </select>
            
            <div class="inputBox">
            <!--p>Enrollment No:</p-->
            <input type="text" id="Enrollment_No" name="Enrollment_No" value="" required> <!--?php echo htmlspecialchars($Enrollment_No); ?-->
            <span>Enrollment No :</span>
            <i></i>
            </div><br>
            
            
            <div class="inputBox">
            <!--P>Course ID:***************************</P-->
            <input type="text" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>"   >
            <span>Course ID :</span> 
            <i></i>
            </div>

            
            <br>
            <div class="inputBox">
            <input type="date" id="EN_dob" name="EN_dob" value="" required>
            <span>Enrollment Date:</span>
            <i></i>
            </div>


            <br><br>
            

            <div class="inputBox1">
            <p style="color: #8f8f8f;" style="font-size: 1.1em;">Please Select your Status :</p>

            <br><br>
            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Enrolled" >  Enrolled
            </label>



            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Dropped" >  Dropped
            </label>

            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Completed">  Completed
            </label>

            <label style="margin-right: 20px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value=" Hold">  Hold
            </label>



            <br><br>
            <br> <br>
            <div class="Apple">
            <input type="submit" value="submit" name="submit">
            <input type="reset" value="Reset">
            <button style="margin-left: 135px;" type="button" value="Back">

            <a style="text-decoration: none;" href="courses.html">Back</a></button>

        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
