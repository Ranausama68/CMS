<?php
session_start();



require_once "../db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
 

</head>
<body>

<div id="Dashboard" class="container-fluid">

    <h1 class="my-3">All Users</h1>
    <a href="../addagent.php" class="text-decoration-none">
        <button class="btn btn-outline-primary">Create New User</button>
    </a><br><br>

    <table class="table table-striped my-2">
        <tr>
            <th>ID</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>   
            <th class="col-1">ACTIONS</th>
        </tr>

        <?php
            $sql = "SELECT * FROM users";

            $result = $con->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_object()){

        ?>
            <tr>
                <td><?= $row->id ?></td>
                <td><?= $row->firstname ?></td>
                <td><?= $row->lastname ?></td>
                <td><?= $row->email ?></td>
                <td><?= $row->role ?></td>
            
                
            <td>
                <div class="d-flex">
                    <button type="button" class="btn btn-danger btn-sm d-inline" data-bs-toggle="modal" data-bs-target="#dltBlog<?= $row->id ?>">
                        Delete
                    </button>
                    <a href="./update-user.php?id=<?= $row->id ?>" class="text-decoration-none">
                        <button class="btn btn-success btn-sm mx-1 d-inline">Update</button>
                    </a>
                </div>
                </td>
            </tr>

            <!-- Button trigger modal -->
            

            <!-- Modal -->
            <div class="modal fade" id="dltBlog<?= $row->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <form action="./delete-user.php" method="post">
                        <input type="hidden" name="user-id" value="<?= $row->id ?>" />
                        <button class="btn btn-danger btn-sm" type="submit">Confirm</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

        <?php
                }
            }
            else {
        ?>
            <tr>
                <th class="text-center" colspan="8">No users to show!</th>
            </tr>
        <?php
            }
        ?>
    </table>

</div>
    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<?php
require_once "../footer.php"
?>
</body>
</html>


