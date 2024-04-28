<?php
require('./db.php');

// Ensure the database connection is initialized
$conn = crud::conect();

// Get student ID from GET or POST data
$stID = isset($_GET['stID']) ? $_GET['stID'] : (isset($_POST['stID']) ? $_POST['stID'] : null);

/*if (!$stID) {
    die("Student ID not provided.");
}*/

if (isset($_POST['submit'])) {
    // Initialize an array to store the fields to update
    $updates = array();

    if (isset($_POST['stID']) && !empty($_POST['stID'])) {
        $updates['StudentId'] = $_POST['stID'];
    }
    
    // Check if each field is set and not empty, then add to $updates array
    if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
        $updates['FirstName'] = $_POST['first_name'];
    }

    if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
        $updates['LastName'] = $_POST['last_name'];
    }

    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $updates['DateOfBirth'] = $_POST['dob'];
    }

    if (isset($_POST['Gender']) && !empty($_POST['Gender'])) {
        $updates['Gender'] = $_POST['Gender'];
    }

    if (isset($_POST['Email']) && !empty($_POST['Email'])) {
        // Check if the new email already exists
        $checkEmail = $conn->prepare('SELECT COUNT(*) FROM students_table WHERE Email = :Email');
        $checkEmail->bindValue(':Email', $_POST['Email']);
        $checkEmail->execute();
        $EmailExists = $checkEmail->fetchColumn();

        if ($EmailExists > 0) {
            echo "<script>alert('Email already exists.');</script>";
        } else {
            $updates['Email'] = $_POST['Email'];
        }
    }

    if (isset($_POST['contact_no']) && !empty($_POST['contact_no'])) {
        $updates['Phone'] = $_POST['contact_no'];
    }

    if (isset($_POST['Address']) && !empty($_POST['Address'])) {
        $updates['Address'] = $_POST['Address'];
    }

    if (isset($_POST['Ename']) && !empty($_POST['Ename'])) {
        $updates['EmergencyContactName'] = $_POST['Ename'];
    }

    if (isset($_POST['Eno']) && !empty($_POST['Eno'])) {
        $updates['EmergencyContactPhone'] = $_POST['Eno'];
    }

    // Only proceed with the update if there are any changes
    if (count($updates) > 0) {
        // Build the dynamic UPDATE query
        $sql = "UPDATE students_table SET ";
        $setParts = array();

        foreach ($updates as $key => $value) {
            $setParts[] = "$key = :$key";
        }

        $sql .= implode(", ", $setParts);
        $sql .= " WHERE StudentId = :id";

        $stmt = $conn->prepare($sql);

        // Bind each update value to the statement
        foreach ($updates as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(':id', $stID);
        $stmt->execute();

       
        header("Location: Details.php");
        exit();
        echo "<script>alert('Successfully updated student information.');</script>";
    } else {
        echo "<script>alert('No changes to update.');</script>";
    }
}


// Fetch student registration data

$sql = "SELECT * FROM `students_table` WHERE StudentId = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $stID);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

$row = $result !== false ? $result : array(); // Assign the fetched data to $row
 


?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <style>
        /* Your CSS code here */
    </style>
</head>
<body>
    <div class="rounded-div">
        <span class="borderAAA"></span>

        <form action="" method="post" autocomplete="off">
            <h2>EDIT STUDENT INFORMATION &#128100;</h2>

            <div class="inputBox">
                <input type="text" id="student_id" name="stID" value="<?php echo $stID; ?>">

                <span>Student ID: &#128394;</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" id="first_name" name="first_name" value="<?php echo $row['FirstName'] ?? ''; ?>">
                <span>First Name: &#128394;</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" id="last_name" name="last_name" value="<?php echo $row['LastName'] ?? ''; ?>">
                <span>Last Name: &#128394;</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="date" id="dob" name="dob" value="<?php echo $row['DateOfBirth'] ?? ''; ?>">
                <span>Date of Birth:</span>
                <i></i>
            </div>

            <div class="inputBox1">
                <p style="color: #8f8f8f;">Please select your gender:</p>

                <label style="margin-right: 29px; color: white;">
                    <input type="radio" id="Gender" name="Gender" value="MALE" <?php if ($row['Gender'] && $row['Gender'] === 'MALE') echo 'checked'; ?>> MALE
                </label>

                <label style="margin-right: 29px; color: white;">
                    <input type="radio" id="Gender" name="Gender" value="FEMALE" <?php if ($row['Gender'] && $row['Gender'] === 'FEMALE') echo 'checked'; ?>> FEMALE
                </label>
            </div>

            <div class="inputBox">
                <input type="text" id="Email" name="Email" value="<?php echo $row['Email'] ?? ''; ?>">
                <span>Email: &#128231;</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" id="contact_no" name="contact_no" value="<?php echo $row['Phone'] ?? ''; ?>">
                <span>Contact Number: &#128383;</span>
                <i></i>
            </div>

            <div class="inputBox">
                <textarea id="Address" name="Address" rows="4"><?php echo $row['Address'] ?? ''; ?></textarea>
                <span>Address:</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" id="Ename" name="Ename" value="<?php echo $row['EmergencyContactName'] ?? ''; ?>">
                <span>Emergency Contact Name:</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" id="Eno" name="Eno" value="<?php echo $row['EmergencyContactPhone'] ?? ''; ?>">
                <span>Emergency Contact Number:</span>
                <i></i>
            </div>

            <br> 

            <div class="Apple">
                <input type="submit" value="Update" name="submit" onclick="return confirm('UPDATE SUCCUESS');">
                <input type="reset" value="Reset">

                <button type="button">Back</a></button>
            </div>
        </form>

        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
