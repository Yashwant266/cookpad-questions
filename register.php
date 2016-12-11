<?php
session_start();
if(isset($_SESSION['usr_id'])) {
  header("Location: index.php");
}
require_once('connect.php');
$error = false;
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection error");

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($dbc, $_POST['name']);
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $cnf_password = mysqli_real_escape_string($dbc, $_POST['cnf_password']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cnf_password) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        if(mysqli_query($dbc, "INSERT INTO member(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="wrapper2">
<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
    
       <legend style="margin:0px auto; font-size:35px;font-weight:600;">Sign Up</legend>
       <br>
       <br>
       <br>
       <label for="name" class="data">Name</label><br>
       <input type="text" class="reg" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>"/><br>
       <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span><br>
       <label for="name" class="data">Email</label><br>
       <input type="text" class="reg" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>"/><br>
       <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span><br>
       <label for="name" class="data">Password</label><br>
       <input type="password" class="reg" name="password" placeholder="Password" required /><br>
       <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span><br>
       <label for="name" class="data">Confirm Password</label><br>
       <input type="password" class="reg" name="cnf_password" placeholder="Confirm Password" required /><br>
       <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
	   <input type="submit" name="register" style="width:85%;margin-top:30px;height:30px;font-size:20px;padding:2px;margin-left:15px;" value="Resister" />
	
</form>

<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
 	<span style="margin-left:15px;margin-top:5px;font-weight:300">Already Registered? <a href="login.php" style="text-decoration:none;">Login Here</a></span>
  </div>
  </body>
  </html>