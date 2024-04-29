<?php
require('./db.php');

// Ensure the database connection is initialized
$conn = crud::conect();

// Get Department ID from GET or POST data
$depID = isset($_GET['Dep_ID']) ? $_GET['Dep_ID'] : (isset($_POST['Dep_ID']) ? $_POST['Dep_ID'] : null);

if (!$depID) {
    die("Department ID not provided.");
}

if (isset($_POST['Submit'])) {
    // Initialize an array to store the fields to update
    $updates = array();

    if (isset($_POST['Dep_Name']) && !empty($_POST['Dep_Name'])) {
        $updates['DepartmentName'] = $_POST['Dep_Name'];
    }

    if (isset($_POST['Dep_ID']) && !empty($_POST['Dep_ID'])) {
        $updates['DepartmentID'] = $_POST['Dep_ID'];
    }

    if (isset($_POST['Dep_Head']) && !empty($_POST['Dep_Head'])) {
        $updates['DepartmentHead'] = $_POST['Dep_Head'];
    }

    if (isset($_POST['location']) && !empty($_POST['location'])) {
        $updates['Location'] = $_POST['location'];
    }

    if (isset($_POST['Dep_Contact_No']) && !empty($_POST['Dep_Contact_No'])) {
        $updates['DEPhone'] = $_POST['Dep_Contact_No'];
    }

    if (isset($_POST['Dep_Email']) && !empty($_POST['Dep_Email'])) {
        $updates['DepEmail'] = $_POST['Dep_Email'];
    }

    // Check if there are changes to update
    if (count($updates) > 0) {
        // Check if the new Department ID already exists (if being updated)
        if (isset($updates['DepartmentID'])) {
            $checkDepID = $conn->prepare("SELECT COUNT(*) FROM departments_table WHERE DepartmentID = :DepartmentID");
            $checkDepID->bindValue(':DepartmentID', $updates['DepartmentID']);
            $checkDepID->execute();
            $DepartmentIDExists = $checkDepID->fetchColumn();

            if ($DepartmentIDExists > 0) {
                echo "<script>alert('Department ID already exists.');</script>";
                return; // Avoid proceeding with the update
            }
        }

        // Build the dynamic UPDATE query
        $sql = "UPDATE departments_table SET ";
        $setParts = array();

        foreach ($updates as $key => $value) {
            $setParts[] = "$key = :$key";
        }

        $sql .= implode(", ", $setParts);
        $sql .= " WHERE DepartmentID = :id";

        $stmt = $conn->prepare($sql);

        // Bind each update value to the statement
        foreach ($updates as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmt->bindValue(':id', $depID); // Bind the original department ID for WHERE condition
        $stmt->execute();

        echo "<script>alert('Successfully updated department information.');</script>";

        header("Location: department_details.php"); // Redirect to details page
        exit();
    } else {
        echo "<script>alert('No changes to update.');</script>";
    }
}

// Fetch department data to populate the form
$sql = "SELECT * FROM departments_table WHERE DepartmentID = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $depID);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

$row = $result !== false ? $result : array(); // Assign the fetched data to $row
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
