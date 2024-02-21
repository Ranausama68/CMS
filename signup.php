<?php
session_start();

require_once "./db.php";

$firstname = $lastname = $email = $password = null;
$success = $error = null;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(empty($_POST['firstname'])){
        $error = "Firstname Is Required";
    }
    if(empty($_POST['lastname'])){
        $error = "Lastname Is Required";
    }
    if(empty($_POST['email'])){
        $error = "Email Is Required";
    }else{
        $email = cleanData($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Email Is Incorrect";
        }
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result =$con->query($query);
        if($result->num_rows > 0){
            $error = "Email Already Exists!";
        }
    }
    if(empty($_POST['pwd'])){
        $error = "Password Is Required";
    }
    else if($_POST['pwd'] !== $_POST['cpwd']){
        $error = "Passwords doesn't match!";
    }
    else if(empty($error)) {
        $firstname = cleanData($_POST['firstname']);
        $lastname = cleanData($_POST['lastname']);
        $email = cleanData($_POST['email']);
        $password = cleanData($_POST['pwd']);

        $hashedpwd = md5($password);

        $query = "INSERT INTO users (firstname,lastname,email,password) VALUES ('{$firstname}', '{$lastname}','{$email}','{$hashedpwd}')";

        $result = $con->query($query);
        if($result){
            $success = "Account Created Successfully...";
        }


    }









}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
      <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" novalidate >
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
                <div class="field input">
                    <label for="username">First Name</label>
                    <input type="text" name="firstname" id="username" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="username">Last Name</label>
                    <input type="text" name="lastname" id="username" autocomplete="off" >
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="pwd" id="password" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password"> Confirm Password</label>
                    <input type="password" name="cpwd" id="password" autocomplete="off">
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
      
      </div>
</body>
</html>