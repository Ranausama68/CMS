<?php
session_start();

if(isset($_SESSION['uid'])){
    header("Location: ./user/home.php");
}

require_once "./db.php";



$email = $password = null;
$error = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(empty($_POST['email'])){
        $error = "Email is required";
    }
    if(empty($_POST['pwd'])){
        $error = "Password is required";
    }
    elseif(empty($error)) {
        $email = cleanData($_POST['email']);
        $password = cleanData($_POST['pwd']);

        $hashedPwd = md5($password);

        echo $sql = "SELECT * FROM users WHERE email = '{$email}' and password = '{$hashedPwd}'";
        // die();
        $result = $con->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_object()){
                $_SESSION['uid'] = $row->id;
                $_SESSION['user-role'] = $row->role;
            }
            if($_SESSION['user-role'] == "admin"){
                header('Location: ./admin/home.php');
            }
            else {
                header('Location: ./user/home.php');
            }
            
        }
        else {
            $error = "Invalid credintials!";
        }
    }

}

?>
























<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">


  <title>Login</title>
</head>
<body>




<div class="container">
    <div class="box form-box">
          
            <header>Login</header>
            <form method="POST" action ="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"  novalidate>
            <?php
            if(isset($error)){
            ?>
             <div class="alert alert-danger">
                <?= $error ?>
             </div>
            <?php
            }
            
            ?>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="pwd" id="password" autocomplete="off">
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account? <a href="signup.php">Sign Up Now</a>
                </div>
            </form>
        </div>
      
      </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>

