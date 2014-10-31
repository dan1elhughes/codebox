<?php
include '../includes/headernologin.php';

if (!isset($_POST['username']))
	{
	$username = "blank";
	}
else {
	$username = mysqli_real_escape_string($dbview, $_POST['username']);
}
if (!isset($_POST['password']))
	{
	$unhashedpassword = "blank";
	}
else {
	$unhashedpassword = $_POST['password'];
}
	
$login_enabled = true;
$login_disabled_reason = "Login disabled.";

if ($login_enabled)
{
	$query = mysqli_query($dbview, "SELECT * FROM users WHERE username = '$username'");
	$result = mysqli_fetch_array($query);
	$password = $result['password'];
	$count = mysqli_num_rows($query);

	if($count==1) {
		if($result['verified']==1) {
			if ($password == crypt($unhashedpassword, $password)) {
				$_SESSION['username']=$username;
				$_SESSION['ID']=$result['ID'];
				$_SESSION['admin']=$result['admin'];
				user_log($result['ID'], 'logged in', '');
			} else {$_SESSION['error'] = 'Incorrect password.';}
		} else {$_SESSION['error'] = 'Account has not been verified.';}
	} else {$_SESSION['error'] = 'Username not found.';}
} else {$_SESSION['error'] = $login_disabled_reason;}
header ('location: ../');
include "../includes/footer.php"; ?>