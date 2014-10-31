<?php include "../../includes/header.php";?>
	<form id="newpaste" method="post" action="sendpaste.php">
		<input type="text" name="title" placeholder="Title"/>
		<pre>
			<textarea rows="20" cols="50" placeholder="Paste your code here." name="code" ></textarea>
		</pre>
		<div class="settings">
			<select name="language"> <?php
foreach ($languages as $lan => $language) {
	echo "\n\t\t\t<option value=\"$lan\"";
	if ($lan=="cpp") {echo " selected=\"selected\" ";}
	echo ">$language</option>";
}
echo "\n";?>
			</select>
			<select name="privacy">
				<option value="0">Public</option>
				<option value="1">Friends</option>
				<option value="2">Private</option>
			</select>
			<button type="submit" name ="submit">Post <i class="fa fa-arrow-right"></i></button>
		</div>
	</form>
<?php include "../../includes/footer.php"; ?>