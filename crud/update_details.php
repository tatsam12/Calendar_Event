<?php

// Include config file
require_once "../config.php";

//Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
// Get hidden input value
    $id = $_POST["id"];



//Validate username
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Please enter a username";
        echo "Please enter a username.";
    } elseif (!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $username_err = "Please enter a valid username";
        echo "Please enter a valid username";
    } else {
        $username = $input_username;
    }

//Validate password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter a password";
        echo "Please enter a password.";
    } elseif (!filter_var($input_password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $password_err = "Please enter a valid password";
        echo "Please enter a valid password";

    } else {
        $password = $input_password;
    }
//Validation of confirm_password
    $input_confirm_password = trim($_POST["confirm_password"]);
    if (empty($input_confirm_password)) {
        $confirm_password_err = "Please enter a confirm_password";
        echo "Please enter a confirm_password";
    } else {
        $confirm_password = $input_confirm_password;
    }

// Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        if ($filename == "") {
            $sql = "UPDATE user SET username=?, password=?, confirm_password=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_password, $param_confirm_password, $param_id);

                // Set parameters
                $param_username = $username;
                $param_password = $password;
                $param_confirm_password = $confirm_password;
                $param_id = $id;
            }
        } else {
            $sql = "UPDATE  user SET username=?, password=?, confirm_password=?, image=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $param_username, $param_password, $param_confirm_password, $filename, $param_id);
                // Set parameters
                $param_username = $username;
                $param_password = $password;
                $param_confirm_password = $confirm_password;
                $param_id = $id;
            }
        }
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {

            // Records updated successfully. Redirect to landing page
            header("location: retrieve_to.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


// Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
        // Prepare a select statement
        $sql = "SELECT * FROM user WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $username = $row["username"];
                    $password = $row["password"];
                    $confirm_password = $row["confirm_password"];

                } else {

                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<?php include "header.php"?>
<br><br>
    <div class="container">
        <h1>Edit page</h1>
<form method="post" action="" enctype="multipart/form-data">
    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"<br><br>
    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>"<br><br>
    <input type="confirm_password" class="form-control" name="confirm_password" value="<?php echo $confirm_password; ?>" <br><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" class="btn btn-primary" value="Update">
</form>
</div>
</body>
</html>