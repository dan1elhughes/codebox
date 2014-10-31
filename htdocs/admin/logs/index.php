<?php include "../../includes/header.php";
checkAdmin();
$query=mysqli_query($dbview, "SELECT * FROM logs");
echo "\n<table border=\"1\" style=\"border-collapse: collapse; width: 100%; max-width: 1024px;\">";?>
	<tr>
		<th>User</th>
		<th>Action</th>
		<th>Data</th>
		<th>Time</th>
		<th>Delete</th>
	</tr>

<?php
while ($result=mysqli_fetch_assoc($query)) {
	echo "\n\t<tr>";
		echo "\n\t\t<td>" . $result['userID'] . "</td>";
		echo "\n\t\t<td>" . $result['action'] . "</td>";
		echo "\n\t\t<td>" . $result['data'] . "</td>";
		echo "\n\t\t<td>" . $result['created'] . "</td>";
		echo "\n\t\t<td><a href=\"delete.php?p=" . $result['ID'] . "\">Delete</a></td>";
	echo "\n\t</tr>";
}
echo "</table>";
include "../../includes/footer.php"; ?>