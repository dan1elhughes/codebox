<?php 
include "../includes/headernologin.php";
if(isset($_SESSION['username'])) {
	header ("location: ../");
}
	
if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	session_destroy();
}
else {
	$error = false;
}
?>
<form id="login" method="post" action="sendlogin.php">
	<p class="field">
		<input type="text" name="username" placeholder="Username"/>
		<i class="fa fa-user fa-fw"></i>
	</p>
    <p class="field">
		<input type="password" name="password" placeholder="Password"/>
		<i class="fa fa-lock fa-fw"></i>
	</p>
	<p class="submit">
		<button type="submit" name ="submit"/><i class="fa fa-arrow-right"></i></button>
	</p>
	<p class="red"><!-- Errors --><?php echo $error;?></p>
	<p><a href="../register/">Register</a></p>
</form>
</div>
<?php include '../includes/footer.php';?>