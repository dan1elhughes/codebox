<?php include "../../includes/header.php";

if (empty($_POST['title'])) {  header ('location: ../new/');  }
else { $title = mysqli_real_escape_string($dbview, $_POST['title']); }

if (empty($_POST['code'])) { header ('location: ../new/');  }
else { $code = mysqli_real_escape_string($dbview, $_POST['code']); }

if (empty($_POST['language'])) {  header ('location: ../new/');  }
else { $language = mysqli_real_escape_string($dbview, $_POST['language']);
}

if (!(isset($_POST['privacy']))) {  header ('location: ../new/');  }
else { $privacy = mysqli_real_escape_string($dbview, $_POST['privacy']); }

$datetime=date("Y-m-d H:i:s");

$newcharID;
do {
$newcharID = substr(md5(microtime()), 0, 8);
$query = mysqli_query($dbview, "SELECT charID FROM posts WHERE charID = '$newcharID'");
$result = mysqli_fetch_array($query);
$count = mysqli_num_rows($query);
} while ($count != 0);

$sql="INSERT INTO posts VALUES ('$newcharID', '$title', '$code', '$language', ". $_SESSION['ID'] .", $privacy, '$datetime')";
if (!mysqli_query($dbedit,$sql)) { die('Error: ' . mysqli_error($dbedit));}
header("location: ../");
include "../../includes/footer.php"; ?>