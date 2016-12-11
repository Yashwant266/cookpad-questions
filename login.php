<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: view.php");
}

require_once('connect.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection error");

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);

	$result = mysqli_query($dbc, "SELECT * FROM member WHERE email = '" .$email. "' and password = '" . md5($password) . "'");
	$row = mysqli_fetch_array($result);
	 if (!empty($row)) {
        $_SESSION['usr_id'] = $row['ID'];
        $_SESSION['usr_name'] = $row['name'];
        header("Location: view.php");
        } 
        else 
        {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Login Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<!--ul>
   <li class="active"><a href="login.php">Login</a></li>
    <li><a href="register.php">Sign Up</a></li>
 </ul-->
 <div id="wrapper">
  <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
    
    <legend style="margin:0px auto; font-size:35px;font-weight:600;">Login</legend>
    <hr>
    <br>
    <br>
   
    <label for="name" style="margin-left:15px;font-size:25px;">Email</label><br>
    <input type="text" class="log" name="email" placeholder="Your Email" required/><br>
    <br>
    <label for="name" style="margin-left:15px;font-size:25px;margin-top:20px;">Password</label><br>
    <br>
    <input type="password" class="log" name="password" placeholder="Your Password" required /><br>
    <input type="submit" name="login" class="log" value="Enter" style="width:85%;margin-top:30px;height:30px;font-size:20px;padding:2px"/>
    <br>
    
   </form>
   			<br>
        <span class="text-danger" style="margin-left:15px;font-weight:300;">
        <?php if (isset($errormsg)) { echo $errormsg;} ?><br>
        </span >
        <span style="font-weight:300;text-decoration:none; margin-left:15px;">New User? <a href="register.php" style="text-decoration:none;">Sign Up Here</a></span>
    </div>
</body>
</html>