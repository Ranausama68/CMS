<?php
session_start();

require_once "./db.php";




$firstname = $lastname = $email = $password = $role = null;
$success = $error = null;

 
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
    $query = "SELECT id FROM users WHERE email = '{$email}'";
    $result = $con->query($query);
    if($result->num_rows > 0){
        $error = "Email already exists!";
    }
}
if(empty($_POST['role'])){
  $error = "Choose your Role!";
}
if(empty($_POST['pwd'])){
    $error = "Password is required!";
}

 else if (empty($error)) {
 

    $firstname = cleanData($_POST['firstname']);
    $lastname = cleanData($_POST['lastname']);
    $email = cleanData($_POST['email']);
    $password = cleanData($_POST['pwd']);
    $role = $_POST['role'];

    $hashedPwd = md5($password);

    
        $sql = "INSERT INTO users (firstname, lastname, email, password,  role) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$hashedPwd}', '{$role}')";
    

    $result = $con->query($sql);

    if($result){
        $success = "User Added Successfully...";
    }
}
}




?>






<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Add Users</title>
  </head>
  <body>
   </div>
   
   <section class="container my-2 w-50 text-dark p-2">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"  class="row g-3 p-3" novalidate>
    <h1 class="text-center">ADD Users</h1>
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
    
        <div class="col-md-6 ">
            <label for="validationDefault01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationDefault01" name="firstname" >
          </div>
          <div class="col-md-6">
            <label for="validationDefault02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationDefault02" name="lastname" >
          </div>
        
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail4 " name="email">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="inputPassword4"name="pwd">
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label" name="role">User Role</label>
          <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option>User</option>
            <option>Agent</option>
          </select>
        </div>
      
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
   </section>
  </body>
</html>