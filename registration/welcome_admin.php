
<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");

}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Calendar login!- HOME</title>
</head>
<body>
<a href="logout.php">Logout</a>
<a href="../index.php">Calendar</a>
<a href="../add_events.php">Add events</a>




<div class="container mt-4">
    <h3><?php echo "Welcome admin". $_SESSION['username']?>! You can now use this website</h3>
    <hr>

</div>
</body>
</html>