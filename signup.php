<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form >
                <div class="field input">
                    <label for="username">First Name</label>
                    <input type="text" name="firstname" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Last Name</label>
                    <input type="text" name="lastname" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password"> Confirm Password</label>
                    <input type="password" name="cpassword" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
      
      </div>
</body>
</html>