<?php include "../includes/header.php";

$newcharID;

do {
$newcharID = substr(md5(microtime()), 0, 8);
$query = mysqli_query($dbview, "SELECT charID FROM posts WHERE charID = '$newcharID'");
$result = mysqli_fetch_array($query);
$count = mysqli_num_rows($query);
} while ($count != 0);

echo $newcharID . " does not exist in the database.\n\n";

include "../includes/footer.php"; ?>