<?php include "../../includes/header.php";

$votes = getVotes();

if(isAdmin()) {
	$postsquery = mysqli_query($dbview, "SELECT * FROM posts ORDER BY created DESC");
}
else {
	$postsquery = mysqli_query($dbview, "SELECT * FROM posts WHERE privacy = 0 ORDER BY created DESC");
}

startPostsTable();
while($result = mysqli_fetch_assoc($postsquery)) { tablePost($result, $votes); }
endPostsTable();

include "../../includes/footer.php"; ?>