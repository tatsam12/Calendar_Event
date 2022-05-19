<?php
require_once "./config.php";


$title = $description = $start_date =$end_date="";
$title_err = $description_err = $start_date_err =$end_date_err="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if title is empty
    if (empty($_POST['title'])) {
        $title_err = "Title cannot be empty";
    } else {
        $sql = "SELECT id FROM event WHERE title = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_title);

            // Set the value of param title
            $param_title =($_POST['title']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $title_err = "This title is already taken";
                    echo $title_err;
                } else {
                    $title = trim($_POST['title']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }




// Check for description
    if (empty($_POST['description'])) {
        $description_err = "description can be blank";
    } elseif (strlen(trim($_POST['description'])) < 5) {
        $description_err = "description cannot be less than 5 characters";
    } else {
        $description = trim($_POST['description']);
    }

    // Check for start_date
    if (empty($_POST['start_date'])) {
        $start_date_err = "start_date cannot be blank";
    } elseif (strlen(trim($_POST['start_date'])) < 5) {
        $start_date_err = "";
    } else {
        $start_date = trim($_POST['start_date']);
    }

// Check for end_date
    if (empty($_POST['end_date'])) {
        $end_date_err = "end_date cannot be blank";
    } elseif (strlen(trim($_POST['end_date'])) < 5) {
        $end_date_err = "";
    } else {
        $end_date = trim($_POST['end_date']);
    }




// If there were no errors, go ahead and insert into the database
    if (empty($title_err) && empty($description_err) && empty($start_date_err) && empty($end_date_err)) {
        $sql = "INSERT INTO event (title, description, start_date,end_date) VALUES (?, ?, ?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_title, $param_description, $param_start_date, $param_end_date);

            // Set these parameters
            $param_title = $title;
            $param_description = $description;
            $param_start_date = $start_date;
            $param_end_date= $end_date;

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location:add_events.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
<head>
</head>
<body>
<h1>Add Events</h1>
<a href="add_events.php">Add Events</a>
<a

<div class="container mt-4">
    <hr>
    <form action="add_events.php" method="post">
        <label class="control-label">Title:</label>
        <input type="text" name="title" class="form-control"/>

    </div>
<div class="form-group"
     <label class="control-label">description:</label>
<textarea name="description"  class="form-control"></textarea>

     </div>
     <div class="form-group">
    <label class="control-label">start_date:</label>
    <input type="datetime-local" name="start_date"  class="form-control"/>

     </div>
<div class="form-group">
    <label class="control-label">end_date:</label>
    <input type="datetime-local" name="end_date"  class="form-control"/>

    <div class="form-group">
        <button type="submit">Add event</button>
    </div>
</form>
</div>
</body>
</html>





