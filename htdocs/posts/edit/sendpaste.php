<?php include "../../includes/header.php";

if (empty($_POST['charID'])) {  header ('location: ../new/');  }
else { $charID = mysqli_real_escape_string($dbview, $_POST['charID']); }

if (empty($_POST['code'])) { header ('location: ../new/');  }
else { $code = mysqli_real_escape_string($dbview, $_POST['code']); }

$sql = "SELECT userID FROM posts WHERE charID = '$charID'";
$query = mysqli_query($dbview, $sql);
$result = mysqli_fetch_array($query);
if ($result['userID']!=$_SESSION['ID']) {
	header("location: ../?p=$charID");
	break;
}

$datetime=date("Y-m-d H:i:s");

$sql="UPDATE posts SET content = '" . $code . "' WHERE charID = '$charID'";
if (!mysqli_query($dbedit,$sql)) { die('Error: ' . mysqli_error($dbedit));}
header("location: ../?p=$charID");
include "../../includes/footer.php"; ?>