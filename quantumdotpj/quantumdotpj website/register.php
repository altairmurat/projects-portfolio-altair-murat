<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	
	//name can contain only alpha characters
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {//email must look like email
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 8) {//password should contain minimum 8 characters
		$error = true;
		$password_error = "Password must be minimum of 8 characters, contain letters both capitalized and low keys, numbers and symbols";
	}
	if (!preg_match("/[a-z ]/",$password)) {//password must contain low keys and capitalized letters
		$error = true;
		$password_error = "Password must be minimum of 8 characters, contain letters both capitalized and low keys, numbers and symbols";
	}
	if (!preg_match("/[A-Z ]/",$password)) {//password must contain low keys and capitalized letters
		$error = true;
		$password_error = "Password must be minimum of 8 characters, contain letters both capitalized and low keys, numbers and symbols";
	}
	if (!preg_match("/[0-9 ]/",$password)) {//password must contain numbers
		$error = true;
		$password_error = "Password must be minimum of 8 characters, contain letters both capitalized and low keys, numbers and symbols";
	}
	if (!preg_match("/[\W ]/",$password)) {//password must contain symbols
		$error = true;
		$password_error = "Password must be minimum of 8 characters, contain letters both capitalized and low keys, numbers and symbols";
	}
	if($password != $cpassword) {//password must match with confirmation
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {//all entered data is delivered into database with encrypted password
		if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
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
</head>
<body>

		<!-- add header -->
			<a href="index.php">NIS Home</a>
		<!-- menu items -->
	
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>

		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform"> //form of signup
				<fieldset>
					<legend>Sign Up</legend>

						<label for="name">Name</label> //Name space
						<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" />
						<span><?php if (isset($name_error)) echo $name_error; ?></span>
			
						<label for="name">Email</label> //Email space
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>"  />
						<span><?php if (isset($email_error)) echo $email_error; ?></span>
	
						<label for="name">Password</label> //Password space
						<input type="password" name="password" placeholder="Password" />
						<span><?php if (isset($password_error)) echo $password_error; ?></span>

						<label for="name">Confirm Password</label> //Confirm password space
						<input type="password" name="cpassword" placeholder="Confirm Password" />
						<span><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
			

						<input type="submit" name="signup" value="Sign Up" />
				</fieldset>
			</form>
			<span ><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span ><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
	
		Already Registered? <a href="login.php">Login Here</a>

</body>
</html>



