<?php
require('./db.php');
session_start();

if(isset($_POST['Submit'])){
    $Dep_Name=$_POST['Dep_Name'];
    $Dep_ID=$_POST['Dep_ID'];
    $Dep_Head=$_POST['Dep_Head'];
    $location=$_POST['location'];
    $Dep_Contact_No=$_POST['Dep_Contact_No'];
    $Dep_Email=$_POST['Dep_Email'];
   

    if(!empty($Dep_Name) && !empty($Dep_ID) && !empty($Dep_Head) && !empty($location) && !empty($Dep_Contact_No) && !empty($Dep_Email))
    {
        $checkDep_ID=crud::conect()->prepare('SELECT COUNT(*) from departments_table WHERE DepartmentID = :DepartmentID');
        $checkDep_ID->bindValue(':DepartmentID',$Dep_ID);
        $checkDep_ID->execute();
        $DepartmentIDExists = $checkDep_ID->fetchColumn();

        if($DepartmentIDExists > 0){
            echo "<script type='text/javascript'> alert('data already exists.')</script>";
        } else {
            $p=crud::conect()->prepare('INSERT INTO departments_table(DepartmentName,DepartmentID,DepartmentHead,Location,DEPhone,DepEmail) VALUES(:A,:B,:C,:D,:E,:F)');

            $p->bindValue(':A',$Dep_Name);
            $p->bindValue(':B',$Dep_ID);
            $p->bindValue(':C',$Dep_Head);
            $p->bindValue(':D',$location);
            $p->bindValue(':E',$Dep_Contact_No);
            $p->bindValue(':F',$Dep_Email);
            $p->execute();


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
     <link rel="stylesheet" type="text/css" href="css/DEP.css">
    <style>
      


    </style>
</head>
<body>
    <div class="rounded-div">
        <span class="borderAAA"></span>
        <form action="" method="post" autocomplete="off">
            
        <h2>DEPARTMENT DEATILS</h2>
            <br><br>
            
            <div class="inputBox">
            <!--p>Department Name:</p-->
            <input type="text" id="Dep_Name" name="Dep_Name" required >
            <span>Enter Your Department Name (Emaild you) :</span>
            <i></i>
            </div>
            
            <br>
            <div class="inputBox">
            <!--P> Department ID:</P-->
            <input type="text" id="Dep_ID" name="Dep_ID" required>
            <span>Enter Your Department ID (Emaild you) :</span> 
            <i></i>
            </div>

            <br>
            <div class="inputBox">
            <!--P>Department Head:</P-->
            <input type="text" id="Dep_Head" name="Dep_Head" required>
            <span>Department Head :</span> 
            <i></i>
            </div>
            <br><br>

            
            <label for="location">Select Location</label>
            <select name="location" id="location" required>
                <option value="" >Location</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kandy">Kandy</option>
                <option value="Matale">Matale</option>
                <option value="Nuwara Eliya">Nuwara Eliya</option>
                <option value="Polonnaruwa"> Polonnaruwa</option>
                <option value="Kurunegala">Kurunegala</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Hambantota">Hambantota</option>
                <option value=" Ratnapura"> Ratnapura</option>
                <option value=" Kegalle"> Kegalle</option>
            </select>
            <br>
            
            
            <div class="inputBox">
            <!--P>Department Contact No:</P-->
            <input type="text" id="Dep_Contact_No" name="Dep_Contact_No" required>
            <span>Enter Department Contact No (Emaild you):</span> 
            <i></i>
            </div>

            <br>
            <div class="inputBox">
            <!--P>Department Email:</P-->
            <input type="text" id="Dep_Email" name="Dep_Email" required>
            <span>Enter Department Email:</span> 
            <i></i>
            </div>


            <br><br>
            <br> 
            <div class="Apple">
            <input type="submit" value="Submit" name="Submit">
            <input type="reset" value="Reset">
            <button style="margin-left: 135px;" type="button" value="Back">  <a style="text-decoration: none;" href="ENROLLMENT DEATILS.html">Back</a></button>
            </div>
        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
