<?php
include('db.php');
$conn=crud::conect();

    $stID = $_POST['stID'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $Gender =isset( $_POST['Gender'] )?$_POST['Gender'] : ' ';
    $Email = $_POST['Email'] ?? '';
    $contact_no = $_POST['contact_no'] ?? '';
    $Address = $_POST['Address'] ?? '';
    $Ename = $_POST['Ename'] ?? '';
    $Eno = $_POST['Eno'] ?? '';

    $sql="UPDATE students_table 
        SET first_name=?,last_name=?,dob=?,Gender=?,Email=?,contact_no=?,
        Address=?,Ename=?,Eno=? WHERE stID=?";

    $stmt = $conn->prepare($sql);
    $stmt ->bind_param("ssi",$stID,$first_name,$last_name,$dob,$Gender,$Email,$contact_no,$Address,$Ename,$Eno);
    
    if($stmt->execute()){
        echo "Record updated successfully.";
    }else{
        echo "Error updating record:".$stmt->error;
    }

    $stmt->close();
    $conn->close();
?>