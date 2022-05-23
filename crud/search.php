<?php

require_once "../config.php";
$conn="";
if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "username") {
        $sql = "SELECT * FROM user WHERE username LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "password") {
        $sql = "SELECT * FROM user WHERE password LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "confirm_password") {
        $sql = "SELECT * FROM user WHERE confirm_password LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    }
}
?>

<?php require 'header.php'?>
<table class="table table-success table-striped">
    <tr>
        <th>id</th>
        <th>username</th>
        <th>password</th>
        <th>confirm_password</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    if (isset($result)) {
        if (mysqli_num_rows($result) == 0) {
            echo "<tr>";
            echo "<td colspan='7'>No data found!!!</td>";
            echo "</tr>";
        }
    }
    ?>
    <?php if (isset($result)) { ?>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><img src="upload/<?php echo $row['image'] ?>" height="2%" width="5%"></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['password'] ?></td>
                <td><?php echo $row['confirm_password'] ?></td>
                <td><a href="update_details.php?id=<?php echo $row["id"] ?>">Edit</a></td>
                <td><a href="delete_details.php? id=<?php echo $row["id"] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    <?php } ?>

</table>
</html>
