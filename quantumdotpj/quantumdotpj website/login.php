<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['name'];
		header("Location: index.php");
	} else {
		$errormsg = "Incorrect Email or Password!!!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>NIS login page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
</head>
<body>	
			<a href="index.php">NIS Home page</a>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>


			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Your Email"/>
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password"/>
						<input type="submit" name="login" value="Login"/>
				</fieldset>
			</form>
			<span><?php if (isset($errormsg)) { echo $errormsg; } ?></span>


		New User? <a href="register.php">Sign Up Here</a>

</body>
</html>
