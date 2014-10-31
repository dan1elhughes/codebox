<?php include "../../includes/header.php";
checkAdmin();
if (!isset($_GET['p'])) {
	header('location: ./');
}
else {
	$ID = mysqli_real_escape_string($dbview, $_GET['p']);
	mysqli_query($dbview, "DELETE FROM logs WHERE ID='$ID'");
	//header('location: ./');
}
include "../../includes/footer.php"; ?>