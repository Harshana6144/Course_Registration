<?php
require ('./db.php');

$conn = crud::conect();

$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : (isset($_POST['course_id']) ? $_POST['course_id'] : null);

if (empty($course_id)) {
    die("Course ID not Provided.");
}

if (isset($_POST['submit'])) {
    $updates = array();

    if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {
        $updates['CourseID'] = $_POST['course_id'];
    }

    if (isset($_POST['Enrollment_No']) && !empty($_POST['Enrollment_No'])) {
        $updates['EnrollmentID'] = $_POST['Enrollment_No'];
    }

    if (isset($_POST['Semester']) && !empty($_POST['Semester'])) {
        $updates['Semester'] = $_POST['Semester'];
    }

    if (isset($_POST['EN_dob']) && !empty($_POST['EN_dob'])) {
        $updates['EnrollmentDate'] = $_POST['EN_dob'];
    }

    if (isset($_POST['stetus']) && !empty($_POST['stetus'])) {
        $updates['Status'] = $_POST['stetus'];
    }

    if (count($updates) > 0) {
        $sql = "UPDATE enrollments_table SET ";  
        $setParts = [];

        
        foreach ($updates as $key => $value) {
            $setParts[] = "$key = :$key";  
        }

        $sql .= implode(" , ", $setParts);  
        $sql .= " WHERE CourseID = :id";  

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind all parameters
        foreach ($updates as $key => $value) {
            $stmt->bindValue(":" . $key, $value); 
        }

        // Bind the course_id parameter
        $stmt->bindValue(':id', $course_id);  // ensure CourseID binding
        $stmt->execute();  // execute the statement

        echo "<script>alert('Successfully updated course information');</script>";
        header("Location:Details.php");
        exit();
    } else {
        echo "<script>alert('No change to update');</script>";
    }
}

$sql = "SELECT * FROM `courses_table` INNER JOIN enrollments_table ON courses_table.CourseID = enrollments_table.CourseID WHERE courses_table.CourseID = :id LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $course_id);  
$stmt->execute();  

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$row = $result !== false ? $result : array();
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

            <?php
            $currentSemester = $row['Semester'] ?? '';
            ?>
            <select name="Semester" id="Semester" >
                <option value="" >Semester</option>
                <option value="Semester 1" <?php echo $currentSemester =="Semester 1" ? 'selected' :'';?>> Semester 1 </option>
                <option value="Semester 2" <?php echo $currentSemester =="Semester 2" ? 'selected' :'';?>> Semester 2 </option>
                <option value="Semester 3" <?php echo $currentSemester =="Semester 3" ? 'selected' :'';?>> Semester 3 </option>
                <option value="Semester 4" <?php echo $currentSemester =="Semester 4" ? 'selected' :'';?>> Semester 4 </option>
                
                
            </select>
            
            <div class="inputBox">
            <!--p>Enrollment No:</p-->
            <input type="text" id="Enrollment_No" name="Enrollment_No" value="<?php echo $row['EnrollmentID'] ?? ''; ?>" > <!--?php echo htmlspecialchars($Enrollment_No); ?-->
            <span>Enrollment No :</span>
            <i></i>
            </div><br>
            
            
            <div class="inputBox">
            <!--P>Course ID:***************************</P-->
            <input type="text" id="course_id" name="course_id" value="<?php echo $course_id; ?>"   >
            <span>Course ID :</span> 
            <i></i>
            </div>

            
            <br>
            <div class="inputBox">
            <input type="date" id="EN_dob" name="EN_dob" value="<?php echo $row['EnrollmentDate'] ?? ''; ?>" >
            <span>Enrollment Date:</span>
            <i></i>
            </div>


            <br><br>
            

            <div class="inputBox1">
            <p style="color: #8f8f8f;" style="font-size: 1.1em;">Please Select your Status :</p>

            <br><br>
            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Enrolled" <?php if($row['Status'] && $row['Status'] ==='Enrolled')echo 'checked';?>> Enrolled
            </label>



            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Dropped" <?php if($row['Status'] && $row['Status'] ==='Dropped')echo 'checked';?>>  Dropped
            </label>

            <label style="margin-right: 29px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value="Completed" <?php if($row['Status'] && $row['Status'] ==='Completed')echo 'checked';?>>  Completed
            </label>

            <label style="margin-right: 20px; color: white;" for="Status">
            <input type="radio" id="stetus" name="stetus" value=" Hold" <?php if($row['Status'] && $row['Status'] ==='Hold')echo 'checked';?>>  Hold
            </label>



            <br><br>
            <br> <br>
            <div class="Apple">
            <input type="submit" value="Update" name="submit" onclick="return confirm('UPDATE SUCCUESS');">
            <input type="reset" value="Reset">
            <button style="margin-left: 135px;" type="button" value="Back">

            <a style="text-decoration: none;" href="courses.html">Back</a></button>

        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
