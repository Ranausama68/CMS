<?php
session_start();

require_once "../db.php";

$userId = $_GET['id'];

$firstname = $lastname = $email  = $role = null;
$error = $success = null;



// Form Handler 
if($_SERVER['REQUEST_METHOD'] === "POST"){
  if(empty($_POST['firstname'])){
    $error = "Firstname is required!";
}

if(empty($_POST['lastname'])){
    $error = "Lastname is required!";
}

if(empty($_POST['email'])){
    $error = "Email is required!";
}
else {
    $email = cleanData($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Email is incorrect!";
    }
    
}


if(empty($_POST['role'])){
  $error = "Choose your Role!";
}


else if (empty($error)) {
    $firstname = cleanData($_POST['firstname']);
    $lastname = cleanData($_POST['lastname']);
    $email = cleanData($_POST['email']);
    $role = $_POST['role'];
   

    
        $sql = "UPDATE users SET firstname = '{$firstname}', lastname = '{$lastname}', email = '{$email}', role ='{$role}' WHERE id = {$userId}";
    
    

    $result = $con->query($sql);

    if($result){
        $success = "User Updated Successfully...";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
   <section class="container my-2 w-50 text-dark p-2">
   <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?= $userId ?>" method="POST" enctype="multipart/form-data" class="row g-3 p-3" novalidate>
    <h1 class="text-center">Update Users</h1>
    <?php
            if(isset($success)){
                
        ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php
            }
            if(isset($error)){
        ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php
            }
        ?>
        <?php
            $sql = "SELECT * FROM users WHERE id = {$userId}";

            $result = $con->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_object()){
        ?><br>
    
        <div class="col-md-6 ">
            <label for="" class="form-label">First name</label>
            <input type="text" class="form-control" name="firstname" value="<?= $row->firstname ?>">
          </div>
          <div class="col-md-6">
            <label for="" class="form-label">Last name</label>
            <input type="text" class="form-control" name="lastname" value="<?= $row->lastname ?>">
          </div>
        
        <div class="col-md-6">
          <label for="" class="form-label">Email</label>
          <input type="email" class="form-control"  name="email" value="<?= $row->email ?>">
        </div>
        
        <div class="col-md-6">
          <label for="inputState" class="form-label">User Role</label>
          <select id="inputState" class="form-select" name="role">
            <option value="">Choose...</option>
            <option value="user">User</option>
            <option value="agent">Agent</option>
          </select>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    
   </section>
      <?PHP
    }}?>
</body>
</html>
