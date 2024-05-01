<?php
require('./db.php');
session_start(); 

if(isset($_POST['submit'])){
    $Course=$_POST['Course'];
    $course_id=$_POST['course_id'];
    $reson=$_POST['reson'];
    $hours=$_POST['hours'];
    $s_dob=$_POST['s_dob'];
    $e_dob=$_POST['e_dob'];
    $ClassNo=$_POST['ClassNo'];

    if(!empty($Course) && !empty($course_id) && !empty($reson) && !empty($hours) && !empty($s_dob) && !empty($e_dob) && !empty( $ClassNo))
    {
        $checkcourse_id=crud::conect()->prepare('SELECT COUNT(*) from courses_table WHERE CourseID = :CourseID');
        $checkcourse_id->bindValue(':CourseID',$course_id);
        $checkcourse_id->execute();
        $course_IDExists = $checkcourse_id->fetchColumn();

        if($course_IDExists > 0){
            echo "<script type='text/javascript'> alert('data already exists.')</script>";
        } else {
            $p=crud::conect()->prepare('INSERT INTO courses_table(CourseName,CourseID,Description,CreditHours,StartDate,EndDate,RoomNumber) VALUES(:c,:ci,:d,:ch,:sd,:ed,:Rn)');

            $p->bindValue(':c',$Course);
            $p->bindValue(':ci',$course_id);
            $p->bindValue(':d',$reson);
            $p->bindValue(':ch',$hours);
            $p->bindValue(':sd',$s_dob);
            $p->bindValue(':ed',$e_dob);
            $p->bindValue(':Rn',$ClassNo);
            $p->execute();

            $_SESSION['course_id'] = $course_id;

            header("Location:ENROLLMENT DEATILS.php");
            exit();
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
     <link rel="stylesheet" type="text/css" href="css/courses.css">
    <style>
      


    </style>
</head>
<body>
    <div class="rounded-div">
        <span class="borderAAA"></span>
        <form action="" method="post" autocomplete="off">
            
        <h2>SELECT COURSE</h2>
            <br>
            <label for="Course">Course</label>
            <select name="Course" id="Course" required>
                <option value="" >Courses</option>
                <option value="BSc(Hons) Computer Systems & Network Engineering"> BSc(Hons)Computer Systems & Network Engineering</option>
                <option value="BSc(Hons)Software Engineering">BSc(Hons) Software Engineering</option>
                <option value="BSc(Hons)Computer Systems Engineering">BSc(Hons) Computer Systems Engineering</option>
                <option value="BSc(Hons)Specialising in Cyber Security">BSc(Hons) Specialising in Cyber Security</option>
                <option value="BSc(Hons)Specialising in Interactive Media">BSc(Hons) Specialising in Interactive Media</option>
                <option value="BSc(Hons)Specialising in Data Science">BSc(Hons) Specialising in Data Science</option>
                
            </select>
           
            
            <div class="inputBox">
            <!--p>Course ID:</p-->
            <input type="text" id="course_id" name="course_id" value=""  required>
            <span>Course ID:</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--P>Why do you choose this course:</P-->
            <input type="text" id="reson" name="reson" value="" required>
            <span>Why do you choose this course :</span> 
            <i></i>
            </div>

            <div class="inputBox">
            <!--P>Credit Houres:</P-->
            <input type="text" id="hours" name="hours" required>
            <span>Credit Houres :</span> 
            <i></i>
            </div>

            
            
            <div class="inputBox">
            <input  type="date" id="s_dob" name="s_dob" required>
            <span style="margin-left: px;">Start Date:</span>
            <i></i>
            </div>


            <div class="inputBox">
            <input type="date" id="e_dob" name="e_dob" required>
            <span>End Date:</span>
           
            <i></i>
            </div>

            

            <div class="inputBox">
            <!--p>Class No: :</p-->
            <input type="text" id="ClassNo" name="ClassNo" required>
            <span>Class No:</span>
            <i></i>
            </div>

            <br><br>
            <br>
            <div class="Apple">
            <input type="submit" value="submit" name="submit">
            <input type="reset" value="Reset">
            <button style="margin-left: 135px;" type="button" value="Back">  <a style="text-decoration: none;" href="STUDENT REGISTRATION.php">Back</a></button>

            </div>
            <br>
            

        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
