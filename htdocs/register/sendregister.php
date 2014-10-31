<?php include "../includes/headernologin.php";

if (!isset($_POST['username'])) {
	$_SESSION['error'] = 'You must enter a username.';
	header('location: ./');
	exit();
} else {$username = mysqli_real_escape_string($dbview, $_POST['username']);}

if (!isset($_POST['password'])) {
	$_SESSION['error'] = 'You must enter a password.';
	header('location: ./');
	exit();
} else {$unhashedpassword = mysqli_real_escape_string($dbview, $_POST['password']);}

if (!isset($_POST['email'])) {
	$_SESSION['error'] = 'You must enter an email.';
	header('location: ./');
	exit();
} else {$email = mysqli_real_escape_string($dbview, $_POST['email']);}

$register_enabled = true;
$register_disabled_reason = "Registration disabled.";

if ($register_enabled)
{
	$query = mysqli_query($dbview, "SELECT username FROM users WHERE username = '$username'");
	$count = mysqli_num_rows($query);
	if($count==1) {
		$_SESSION['error'] = 'Username already in use.';
		header('location: ./');
		exit();
	}
	else if(strlen($username) < 4){
		$_SESSION['error'] = 'Username must be at least 4 characters.';
		header('location: ./');
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$_SESSION['error'] = 'Invalid email address.';
		header('location: ./');
		exit();
	}
	else {
		$password = crypt($unhashedpassword, "$2a$10$".substr(md5(microtime()), 0, 22));
		$query = mysqli_query($dbedit, "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
		user_log(mysqli_insert_id($dbedit), 'registered', '');
		$_SESSION['error'] = 'Account created. You will be verified as soon as possible.';
		header('location: ../login/');
		exit();
	}
} else {$_SESSION['error'] = $register_disabled_reason;}
header ('location: ./');
include "../includes/footer.php"; ?>