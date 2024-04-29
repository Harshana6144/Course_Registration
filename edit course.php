<?php
require('./db.php');

// Ensure the database connection is initialized
$conn = crud::conect();

// Get course ID from GET or POST data
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : (isset($_POST['course_id']) ? $_POST['course_id'] : null);

// Validate that course_id is set and not empty
if (empty($course_id)) {
    die("Course ID not provided.");
}



if (isset($_POST['submit'])) {
    // Initialize an array to store the fields to update
    $updates = array();

    // Check if course ID is in POST and update if valid
    if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {
        $updates['CourseID'] = $_POST['course_id']; // Corrected key to align with POST key
    }

    // Check if each field is set and not empty, then add to $updates array
    if (isset($_POST['Course']) && !empty($_POST['Course'])) {
        $updates['CourseName'] = $_POST['Course'];
    }

    if (isset($_POST['reson']) && !empty($_POST['reson'])) {
        $updates['Description'] = $_POST['reson']; // Corrected variable usage
    }

    if (isset($_POST['hours']) && !empty($_POST['hours'])) {
        $updates['CreditHours'] = $_POST['hours'];
    }

    if (isset($_POST['s_dob']) && !empty($_POST['s_dob'])) {
        $updates['StartDate'] = $_POST['s_dob'];
    }

    if (isset($_POST['e_dob']) && !empty($_POST['e_dob'])) {
        $updates['EndDate'] = $_POST['e_dob'];
    }

    if (isset($_POST['ClassNo']) && !empty($_POST['ClassNo'])) {
        $updates['RoomNumber'] = $_POST['ClassNo'];
    }

    // Check if there are changes to update
    if (count($updates) > 0) {
        // Build the dynamic UPDATE query
        $sql = "UPDATE courses_table SET ";
        $setParts = array();

        foreach ($updates as $key => $value) {
            $setParts[] = "$key = :$key";
        }

        $sql .= implode(", ", $setParts);
        $sql .= " WHERE CourseID = :id";

        $stmt = $conn->prepare($sql);

        // Bind each update value to the statement
        foreach ($updates as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        // Corrected binding of course_id
        $stmt->bindValue(':id', $course_id); // Ensure that this variable is properly initialized
        $stmt->execute();

        echo "<script>alert('Successfully updated course information.');</script>";

        header("Location: Details.php");
        exit(); // Ensure exit to prevent further execution
    } else {
        echo "<script>alert('No changes to update.');</script>";
    }
}

// Fetch the course data to populate the form
$sql = "SELECT * FROM `courses_table` WHERE CourseID = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $course_id); // Corrected variable binding
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

$row = $result !== false ? $result : array(); // Assign the fetched data to `$row`


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
            
        <h2>EDIT COURSE</h2>
            <br>
            <label for="Course">Course</label>
            <select name="Course" id="Course" value="">
                <option value="<?php echo $row['CourseName'] ?>">Courses</option>
                <option value="BSc(Hons) Computer Systems & Network Engineering"> BSc(Hons)Computer Systems & Network Engineering</option>
                <option value="BSc(Hons)Software Engineering">BSc(Hons) Software Engineering</option>
                <option value="BSc(Hons)Computer Systems Engineering">BSc(Hons) Computer Systems Engineering</option>
                <option value="BSc(Hons)Specialising in Cyber Security">BSc(Hons) Specialising in Cyber Security</option>
                <option value="BSc(Hons)Specialising in Interactive Media">BSc(Hons) Specialising in Interactive Media</option>
                <option value="BSc(Hons)Specialising in Data Science">BSc(Hons) Specialising in Data Science</option>
                
            </select>
           
            
            <div class="inputBox">
            <!--p>Course ID:</p-->
            <input type="text" id="course_id" name="course_id" value="<?php echo $course_id; ?>" >
            <span>Course ID:</span>
            <i></i>
            </div>

            <div class="inputBox">
            <!--P>Why do you choose this course:</P-->
            <input type="text" id="reson" name="reson" value="<?php echo $row['Description'] ?? ''; ?>" >
            <span>Why do you choose this course :</span> 
            <i></i>
            </div>

            <div class="inputBox">
            <!--P>Credit Houres:</P-->
            <input type="text" id="hours" name="hours" value="<?php echo $row['CreditHours'] ?? ''; ?>" >
            <span>Credit Houres :</span> 
            <i></i>
            </div>

            
            
            <div class="inputBox">
            <input  type="date" id="s_dob" name="s_dob" >
            <span style="margin-left: px;">Start Date:</span>
            <i></i>
            </div>


            <div class="inputBox">
            <input type="date" id="e_dob" name="e_dob" >
            <span>End Date:</span>
           
            <i></i>
            </div>

            

            <div class="inputBox">
            <!--p>Class No: :</p-->
            <input type="text" id="ClassNo" name="ClassNo" >
            <span>Class No:</span>
            <i></i>
            </div>

            <br><br>
            <br>
            <div class="Apple">
            <input type="submit" value="Update" name="submit" onclick="return confirm('UPDATE SUCCUESS');">
            <input type="reset" value="Reset">
            <button style="margin-left: 135px;" type="button" value="Back">  <a style="text-decoration: none;" href="STUDENT REGISTRATION.php">Back</a></button>

            </div>
            <br>
            

        </form>

        
        <script type="text/javascript" src="JS/main.js"></script>
    </div>
</body>
</html>
