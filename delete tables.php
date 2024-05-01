<?php
require('./db.php');

$conn = crud::conect();

if(isset($_POST['delete_all'])){
    $conn->beginTransaction();

    try{
        $sql="DELETE FROM enrollments_table";
        $conn->exec($sql);

        $sql="DELETE FROM courses_table";
        $conn->exec($sql);

        $sql="DELETE FROM students_table";
        $conn->exec($sql);

        $sql="DELETE FROM departments_table";
        $conn->exec($sql);

        $sql="DELETE FROM login_table";
        $conn->exec($sql);

        $conn->commit();

        echo"<script>alert('All data deleted successfully');</script>";
        header("Location:Details.php");
        exit();
    }catch(PDOException $e){
        $conn->rollBack();
        echo"<script>alert('Error deleting data:". $e->getMessage()."');</script>";
    }
}

?>