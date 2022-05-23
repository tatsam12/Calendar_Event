<?php
require_once "../config.php";

// Define variables and initialize with empty values
$username= $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Please enter a first name.";
        echo "Please enter a first name.";

    } elseif (!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $username_err = "Please enter a valid first name.";
        echo "Please enter a valid first name.";

    } else {
        $username = $input_username;
    }

// Validate last name
    $input_confirm_password = trim($_POST["confirm_password"]);
    if (empty($input_confirm_password)) {
        $confirm_password_err = "Please enter a confirm_password.";
        echo "Please enter a confirm_password";
    } else {
        $confirm_password = $input_confirm_password;
    }

// Validate last name
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter a last name.";
        echo "Please enter a last name.";
    } elseif (!filter_var($input_password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $password_err = "Please enter a valid last name.";
        echo "Please enter a valid last name.";
    } else {
        $password = $input_password;
    }



    if (empty($username_err_err) && empty($password_err) && empty($confirm_password_err)) {
// Prepare an insert statement


        $sql = "INSERT INTO user (username, password, confirm_password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $confirm_password, $filename);

            // Set parameters
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: retrieve_to.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>

<html>
<head><title>Create</title></head>
<?php include "header.php" ?>
<div class="container mt-3">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Php Project</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="retrieve_to.php">List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br> <br> <br>
    <h2>Create page</h2>
    <div class="row">
        <form action="create.php" method="post" enctype="multipart/form-data">

            <input type="text" id="username" placeholder="Enter Username" name="username" class="form-control"><br>
            <input type="text" id="password" placeholder="Enter the password" name="password" class="form-control"><br>
            <input type="confirm_password" id="confirm_password" placeholder="Confirm your password" name="confirm_password" class="form-control"><br>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</html>