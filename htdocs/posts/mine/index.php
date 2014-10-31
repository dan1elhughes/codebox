<?php include "../../includes/header.php";?>
<p><a href="../new/">New paste</a></p>
<?php $sql = "SELECT * FROM posts WHERE userID = ". $_SESSION['ID']." ORDER BY created DESC";

$votes = getVotes();

$query = mysqli_query($dbview, $sql);
startPostsTable();
while($result = mysqli_fetch_array($query)) { tablePost($result, $votes); }
endPostsTable();
include "../../includes/footer.php"; ?>