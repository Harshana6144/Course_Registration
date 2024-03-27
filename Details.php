<?php

$con=mysqli_connect('localhost','root','','course_registration');
$sql1="SELECT * FROM students_table ";
$sqldata1=$con->query($sql1);
$row=mysqli_fetch_assoc($sqldata1);

$sql2="SELECT * FROM courses_table inner join enrollments_table";
$sqldata2=$con->query($sql2);
$row2=mysqli_fetch_assoc($sqldata2);

$sql3="SELECT * FROM departments_table";
$sqldata3=$con->query($sql3);
$row3=mysqli_fetch_assoc($sqldata3);


?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    .apple {
      overflow: hidden;
      background-color: #00DFA2;
      text-align: center;
    }

    .tab, th {
      font-weight: 1.2em;
      border: 3px solid #2E97A7;
      background-color: #ddd;
      border-radius: 10px;
      margin-left: 50px; 
    }

    .tab td {
      font-size: 23px; 
     
    }

    .tab {
      width: 90%;
      margin-left: auto; 
      margin-right: auto;
      
    }

    .tab tr {
      background-color: #04AA6D;
      font-weight: 1.2em;
    }
    legend{


    }

    /*.button{
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 6px 5px;
    cursor: pointer;
  }*/

  input{
     
      height: 40px;
      border-radius: 10px;
      border: none;
      background-color: #ddd;
      
     
      }
  textarea{
      width:850px ;
      height: 70px;
      border-radius: 10px;
      background-color: #ddd;
       
      }    

  /*.button.delete {
      background-color: #FF5733;
      left: 100px;
      }

  .button.edit {
      background-color: #33A5FF;
      }
      h3{
        margin-left: 20px;
      }*/
  /*.button:hover{
    background-color: #ddd;
  }*/

  .button {
  display: inline-block;
  padding: 10px 24px;
  font-size: 13px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #f4511e;
  border: none;
  border-radius: 15px;
  box-shadow: 0 7px #999;
  margin-top: 20px;

}

.button:hover {
  background-color: #3e8e41;
}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translate(4px);
}


/*===============================================================*/
  .Print{
    display: inline-block;
    padding: 8px 24px;
    margin-left:1690px;
    margin-bottom:30px ;
    font-size: 13px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline:none ;
    color: #fff;
    background-color: #f4511e;
    border:none ;
    border-radius: 15px;
    box-shadow:0 7px #999;
  }

  .Print:hover{
    background-color: #3e8e41;
  }

  .Print:active{
    background-color: #3e8e41;
    box-shadow:0 5px #666;
    transform: translate(4px);
  }

  h1
  {
    font-family: Arial, Helvetica, sans-serif;
  }

  h3
  {
    margin-left: 60px;
    font-family: Arial, Helvetica, sans-serif;
  }

  fieldset
  {
    border: 2px solid #b0b0b0;
    padding: px;
  }

  legend
  {
    font-family: Arial, Helvetica, sans-serif;
    color: #2a752e;
    font-size: 25px;


  }

  footer{
        background-color: #4CAF50;
        height: 25px;
        text-align: center;
        color: rgba(255,255,255,0.9);
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding-top: 15px;
        padding-bottom: 1px;
        font-family: arial;
        font-size: 14px;
    }
    .ppp{
      text-align:left;
      padding:6px;
      width:350px;
      
    }
    .w3-hover-red:hover {
      background-color: #f44336;
    }

  .button-container{
  margin-left:1250px;
  }

  .span{
    margin-left:280px;
    font-size:25px;
  }
  

  </style>
  <title></title>
</head>
<body>



  <div class="apple">
    <h1>ONLINE COURSE REGISTRATION</h1>
    <h1>YOUR DETAILS</h1>
  </div>
  <hr>
   <fieldset>
  <legend>Your Details</legend>

  <p>&nbsp;</p>
  <h3>STUDENT INFORMATION</h3>

  <hr>

  <table class="tab">
    <tr >
      <td class="ppp">Student ID:</td>
      <td ><!--input style="width:850px ;" type="text"  id="student_id" name="student_id" value=""--><span class="span">&#128204;<?php echo $row['StudentId']?></span></td>
    </tr>

    <tr>
      <td class="ppp">First Name:</td>
      <td><!--input style="width:850px ;" type="text"  id="first_name" name="first_name" value=""--><span class="span">&#128204;<?php echo $row['FirstName']?></span></td>
    </tr>

     <tr>
      <td class="ppp">Last Name:</td>
      <td><!--input style="width:850px ;" type="text"  id="last_name" name="last_name" value=""--><span class="span"><?php echo $row['LastName']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Date of Birth:</td>
      <td><!--input style="width:850px ;" type="text"  id="dob" name="dob" value=" "--><span class="span"><?php echo $row['DateOfBirth']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Gender:</td>
      <td><span class="span"><?php echo $row['Gender']?></span></span></td>
    </tr>

    <tr>
      <td class="ppp">Email</td>
      <td><span class="span"><?php echo $row['Email']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Contact Number:</td>
      <td><span class="span"><?php echo $row['Phone']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Address:</td>
      <td> 
      <span class="span"><?php echo $row['Address']?></span>
    </td>
    </tr>

    <tr>
      <td class="ppp">Emergency Contact Name:</td>
      <td><span class="span"><?php echo $row['EmergencyContactName']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Emergency Contact No:</td>
      <td><span class="span"><?php echo $row['EmergencyContactPhone']?></span></td> 

    </tr>
   
 </table>

<div class="button-container">
<button class="button" value="">Delete</button>
<button class="button" value="">Edit</button>
</div>



  <!--p>&nbsp;</p-->
  <h3>YOU SELECTED COURSE</h3>
<hr>
<table class="tab">
    <tr>
    <td class="ppp">Courses:</td>
      <td><span class="span"><?php echo $row2['CourseName']?></span></td>
    </tr>

    <td class="ppp">Courses ID:</td>
      <td><span class="span"><?php echo $row2['CourseID']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Selected Reson:</td>
      <td><span class="span"><?php echo $row2['Description']?></span></td>
    </tr>

     <tr>
      <td class="ppp">Credit Houres:</td>
      <td><span class="span"><?php echo $row2['CreditHours']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Course Start Date:</td>
      <td><span class="span"><?php echo $row2['StartDate']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Course End Date:</td>
      <td><span class="span"><?php echo $row2['EndDate']?></span></td>
    </tr>

    <tr>
      <td class="ppp">Class No: </td>
      <td><span class="span"><?php echo $row2['RoomNumber']?></span></td>
    </tr>
  </table>

<div class="button-container">
<button class="button" value="">Delete</button>
<button class="button" value="">Edit</button> 
</div>

<!--p>&nbsp;</p-->
<h3>ENROLLMENT DEATILS</h3>
<hr>
<table class="tab">

<tr>
      <td class="ppp">Semester :</td>
      <td><?php echo $row2['Semester']?></td>
    </tr>


    <tr>
      <td class="ppp">Enrollment No :</td>
      <td><?php echo $row2['EnrollmentID']?></td>
    </tr>

   

     <tr>
      <td class="ppp">Course ID :</td>
      <td><?php echo $row2['CourseID']?></td>
    </tr>

    <tr>
      <td class="ppp">Enrollment Date :</td>
      <td><?php echo $row2['EnrollmentDate']?></td>
    </tr>

    <tr>
      <td class="ppp">your Status :</td>
      <td><?php echo $row2['Status']?></td>
    </tr>

</table>
<div class="button-container">
<button class="button" value="">Delete</button>
<button class="button" value="">Edit</button> 
</div>
<!--p>&nbsp;</p-->
<h3>DEPARTMENT DEATILS</h3>
<hr>
<table class="tab">
    <tr>
      <td class="ppp">Your Department Name (Emaild you) :</td>
      <td><?php echo $row3['DepartmentName']?></td>
    </tr>

    <tr>
      <td class="ppp">Your Department ID (Emaild you) :</td>
      <td><?php echo $row3['DepartmentID']?></td>
    </tr>

     <tr>
      <td class="ppp">Department Head :</td>
      <td><?php echo $row3['DepartmentHead']?></td>
    </tr>

    <tr>
      <td class="ppp"> Location:</td>
      <td><?php echo $row3['Location']?></td>
    </tr>

    <tr>
      <td class="ppp">Department Contact No (Emaild you):</td>
      <td><?php echo $row3['DEPhone']?></td>
    </tr>

    <tr>
      <td class="ppp">Department Email:</td>
      <td><?php echo $row3['DepEmail']?></td>
    </tr>

</table>

<div class="button-container">
<button class="button" value="">Delete</button>
<button class="button" value="">Delete</button>
</div> 
<p-->
  <!--button class="button" value="">Edit</button-->
  
<br>
</p>
<!=====================================================================>


 
</fieldset>
<footer>
        Sri Lanka Online Registration Service 2023.ALL Right Reseverd. &copy;
    </footer> 

</html>
