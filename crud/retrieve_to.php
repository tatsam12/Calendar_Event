<?php
require_once "../config.php";
$sql = "SELECT * FROM user";
$result=mysqli_query($conn,$sql)
?>
<?php include "header.php";?>
<table class="table table-success table-striped">
<tr>
    <th>id</th>
    <th>username</th>
    <th>password</th>
    <th>confirm_password</th>
    <th>Action</th>
<!--    <th>Delete</th>-->
</tr>
    <?php foreach ($result as $row){ ?>
     <tr>
     <td><?php echo$row['id']?></td>
     <td><?php echo $row['username']?></td>
     <td><?php echo $row['password']?></td>
     <td><?php echo $row['confirm_password']?></td>
<!--     <td><a href="update_details.php?id=--><?php //echo $row["id"]?><!--">Edit</a></td>-->
<!--     <td><a href="delete_details.php? id=--><?php //echo $row["id"]?><!--">Delete</a> </td>-->
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="update_details.php?id=<?php echo $row["id"]?>">Edit</a></li>
                <li><a class="dropdown-item" href="delete_details.php? id=<?php echo $row["id"]?>">Delete</a></li>
            </ul>
        </div>
    </td>
     </tr>
     <?php } ?>
 </table>


