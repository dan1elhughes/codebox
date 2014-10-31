<?php include "../../includes/header.php";
if(isset($_GET['p'])) {
	$postID = mysqli_real_escape_string($dbview, $_GET['p']);
	$sql = "SELECT * FROM posts WHERE charID = '$postID'";
	$query = mysqli_query($dbview, $sql);
	$result=mysqli_fetch_array($query);
}
else {
	header ("location: $rootpath" . "posts/mine");
}

$lines=$result['content'];
$lines=htmlspecialchars($lines);
$lines=str_replace('\r\n', "\n", $lines);
$lines=stripslashes($lines);
$lines=explode("\n", $lines);?>
	<form id="newpaste" method="post" action="sendpaste.php">
		<input type="text" name="title" placeholder="<?php echo htmlspecialchars($result['title']);?>" readonly/>
		<input type="hidden" name="charID" value="<?php echo $postID;?>">
		<pre>
			<textarea rows="20" cols="50" placeholder="Paste your code here." name="code" ><?
			for ($i = 0; $i < count($lines); $i++) {
				echo $lines[$i]."\n";
			}
			?></textarea>
		</pre>
		<div class="settings">
			<button type="submit" name ="submit">Save <i class="fa fa-arrow-right"></i></button>
		</div>
	</form>
<?php include "../../includes/footer.php"; ?>