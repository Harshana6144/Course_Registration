<?php
require('./db.php');
/*session_start(); // Start the session

if (isset($_SESSION['stID']) && !empty($_SESSION['stID'])) {
    $stID = $_SESSION['stID'];
} else {
    $stID = "No Student ID provided" ;
}*/

//$localStID = $stID;

if (isset($_POST['submit'])) {
    $stID = $_POST['stID'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $Gender =isset( $_POST['Gender'] )?$_POST['Gender'] : ' ';
    $Email = $_POST['Email'];
    $contact_no = $_POST['contact_no'];
    $Address = $_POST['Address'];
    $Ename = $_POST['Ename'];
    $Eno = $_POST['Eno'];
   

    if (
        !empty($first_name) && !empty($last_name) && !empty($dob) &&
        !empty($Gender) && !empty($Email) && !empty($contact_no) &&
        !empty($Address) && !empty($Ename) && !empty($Eno)
    ) {
        $checkEmail = crud::conect()->prepare('SELECT COUNT(*) FROM students_table WHERE Email = :Email');
        $checkEmail->bindValue(':Email', $Email);
        $checkEmail->execute();
        $EmailExists = $checkEmail->fetchColumn();

        if ($EmailExists > 0) {
            echo "<script type='text/javascript'> alert('data already exists.')</script>";
        } else {
            $p = crud::conect()->prepare('INSERT INTO students_table(StudentId ,FirstName,LastName,DateOfBirth,Gender,Email,Phone,Address,EmergencyContactName,EmergencyContactPhone) VALUES(:s,:f,:L,:d,:g,:e,:c,:a,:Ec,:En)');
            
            $p->bindValue(':s', $stID);
            $p->bindValue(':f', $first_name);
            $p->bindValue(':L', $last_name);
            $p->bindValue(':d', $dob);
            $p->bindValue(':g', $Gender);
            $p->bindValue(':e', $Email);
            $p->bindValue(':c', $contact_no);
            $p->bindValue(':a', $Address);
            $p->bindValue(':Ec', $Ename);
            $p->bindValue(':En', $Eno);
            $p->execute();

            header("Location:courses.php");
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
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <style>
      


    </style>
</head>
<body>
    <div class="rounded-div">
        <span class="borderAAA"></span>
        <form action="" method="post" autocomplete="off">
            
        <h2>STUDENT INFORMATION&#128100;</h2>
            
            <div class="inputBox">
            <!--p>Student ID:</p-->
            <input type="text" id="student_id" name="stID" value="" required >
           
            <span>Student ID:  &#128394;</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--P>First Name:</P-->
            <input type="text"  id="first_name" name="first_name"  required>
            <span>First Name: &#128394;</span> 
            <i></i>
            </div>

            <div class="inputBox">
            <!--p>Last Name:</p-->
            <input type="text"  id="last_name" name="last_name" required>
            <span>Last Name: &#128394;</span>
            <i></i>
            </div>

            
            <div class="inputBox">
            <input type="date" id="dob" name="dob" required>
            <span>Date of Birth:</span>
            <i></i>
            </div>

            <br><br>

            <div class="inputBox1">
            <p style="color: #8f8f8f;" style="font-size: 1.1em;">Please Select your Gender :</p>

            <br><br>
            <label style="margin-right: 29px; color: white;" for="Gender">
            <input type="radio" id="Gender" name="Gender" value="MALE">  MALE
            </label>

            <label style="margin-right: 29px; color: white;" for="male">
            <input type="radio" id="Gender" name="Gender" value="FEMALE">  FEMALE
            </label>
            
            <div class="inputBox">
            <input type="text"  id="Email" name="Email" required>
            <span>Email:&#128231;</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--p>Contact Number:</p-->
            <input type="text"  id="contact_no" name="contact_no" required>
            <span>Contact Number:&#128383;</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--p>Address:</p-->
            <textarea id="Address" name="Address" rows="4" cols="35" required>
                
            </textarea>
            <span>Address</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--p>Emergency Contact Name :</p-->
            <input type="text"  id="name" name="Ename" required>
            <span>Emergency Contact Name :</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--p>Emergency Contact No :</p-->
            <input type="text"  id="no" name="Eno" required>
            <span>Emergency Contact No :</span>
            <i></i>
            </div>
            <br>

            <br> 
            <div class="Apple">

            
            <input type="submit" value="submit" name="submit"></a>
            <!--button>test</button-->
         
           

            <input type="reset" value="Reset">

           
            <button style="margin-left: 135px;" type="button" value="Back"> <a style="text-decoration: none;" href="index.php">Back</a></button>
         

        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
