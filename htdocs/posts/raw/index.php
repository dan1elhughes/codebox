<?php include "../../includes/settings.php";
include "../../includes/functions.php";

if(isset($_GET['p'])) {
	$postID = mysqli_real_escape_string($dbview, $_GET['p']);
	$sql = "SELECT * FROM posts WHERE charID = '$postID'";
	$query = mysqli_query($dbview, $sql);
	$result=mysqli_fetch_array($query);
		if (($result['userID'] == $_SESSION['ID']) || ($result['privacy'] == 0) || (isAdmin())) {
			//user_log($_SESSION['ID'], "downloaded", "<a href=$rootpath"."posts?p=$postID>Post $postID</a>");
			//header("Content-disposition: attachment; filename=codebox - " . htmlspecialchars($result['title']) . ".txt");
			//header('Content-type: text/plain');
			//echo "/* SENT VIA ".substr(strtoupper($rooturl.$rootpath), 0, -1)." */\n";
			echo "<pre>\n".$result['content']."\n</pre>";
		}
}
else {
	header('location: ../');
}
?>