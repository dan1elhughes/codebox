<?php include "../../includes/header.php";

if(isset($_GET['p'])) {
	$postID = mysqli_real_escape_string($dbedit, $_GET['p']);
	$sql = "SELECT * FROM posts WHERE charID = '$postID'";
	$query = mysqli_query($dbedit, $sql);
	$result = mysqli_fetch_array($query);
		if (($result['userID'] == $_SESSION['ID']) || (isAdmin())) {
			mysqli_query($dbedit, "DELETE FROM posts WHERE charID = '$postID'");
			user_log($_SESSION['ID'], "deleted", "$postID");
		}
}
header('location: ../mine/');
?>