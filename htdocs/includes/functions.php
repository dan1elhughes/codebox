<?php

function user_log($user, $action, $data) {
	global $dbedit;
	mysqli_query($dbedit, "INSERT INTO logs (userID, action, data) VALUES ('$user', '$action', '$data')");
}

function checkAdmin() {
	if ($_SESSION['admin'] != 1) {
		header('location: ../');
	}
}

function isAdmin() {
	if ($_SESSION['admin']) {
		return 1;
	}
	else {
		return 0;
	}	
}

function truncateString($string, $length) {
	if (strlen($string) > $length) {
		$string = substr($string, 0, $length) . "..";
	}
	return $string;
}

function getVotes() {
	global $dbview;
	$votesquery=mysqli_query($dbview, "SELECT charID, direction FROM votes");
	$votes=array();
	while($line = mysqli_fetch_assoc($votesquery)) {
		$votes[] = $line;
	}
	return $votes;
}

function post($result, $votes) {
	global $rootpath, $languages;

	$upvotes = 0;
	$downvotes = 0;

	for ($i = 0; $i < count($votes); $i++) {
		if ($votes[$i]['charID'] == $result['charID']) {
			if ($votes[$i]['direction'] == 'up') {
				$upvotes++;
			}
			else if ($votes[$i]['direction'] == 'down') {
				$downvotes++;
			}
		}
	}

	$lines=$result['content'];
	$lines=htmlspecialchars($lines);
	$lines=str_replace('\r\n', "\n", $lines);
	$lines=stripslashes($lines);
	$lines=explode("\n", $lines);?>
	<div class="codeblock">
		<div class="center tag">
			<p><h2><?php echo htmlspecialchars($result['title']);?></h2></p>
			<p><span class="green"><i class="fa fa-long-arrow-up"></i><?php echo $upvotes;?></span> <span class="red"><i class="fa fa-long-arrow-down"></i><?php echo $downvotes;?></span></p>
			<p><a href="<?php echo $rootpath;?>posts/raw/?p=<?php echo $result['charID'];?>">Original upload</a><?php 
			if ((isAdmin()) || ($result['userID'] == $_SESSION['ID'])) {
				echo " | <a href=\"". $rootpath . "posts/delete/?p=" . $result['charID'] . "\">Delete</a>";
			}?></p>
		</div>
		<div class="left tag">
			<p><?php echo date_format(date_create($result['created']), 'd/m/Y');?> by <?php echo $result['userID'];
			if ($result['userID'] == $_SESSION['ID']){ echo " <a href=\"" . $GLOBALS['rootpath'] . "posts/edit/?p=" . $result['charID'] . "\">(Edit)</a>";}
			?></p>
			<p><?php switch($result['privacy']) {
			case 0: echo 'Public'; break;
			case 1: echo 'Shared'; break;
			case 2: echo 'Private'; break;
			default: echo 'Error: Undefined privacy'; break;
			}?></p>
			<p><?php echo $languages[$result['language']];?></p>
		<p>This is a short but interesting description of the code below.</p>
		</div>
	<pre class="prettyprint smallpost linenums lang-<?php echo $result['language'];?>"><?php
	for ($i = 0; $i < count($lines); $i++) {
		echo $lines[$i]."\n";
	}
	?></pre>
	</div>
	<?php
}

function startPostsTable() {
	global $dbview;
	$votes = array();
	$query = mysqli_query($dbview, "SELECT charID, direction FROM votes");
	?>
	<table id="postsTable">
	<?php
}

function tablePost($result, $votes) {
	global $rootpath;
	global $languages;

	$upvotes = 0;
	$downvotes = 0;

	for ($i = 0; $i < count($votes); $i++) {
		if ($votes[$i]['charID'] == $result['charID']) {
			if ($votes[$i]['direction'] == 'up') {
				$upvotes++;
			}
			else if ($votes[$i]['direction'] == 'down') {
				$downvotes++;
			}
		}
	}

	echo "\n<tr>";
		echo "\n\t<td class=\"nomobile\">";
			echo "<span class=\"green\"><i class=\"fa fa-long-arrow-up\"></i>$upvotes</span> <span class=\"red\"><i class=\"fa fa-long-arrow-down\"></i>$downvotes</span>";
		echo "</td>";
		echo "\n\t<td>";
			echo "<a href=\"". $rootpath ."posts/?p=" . $result['charID'] . "\">" . htmlspecialchars(truncateString($result['title'], 30)) . "</a>";
		echo "</td>";
		echo "\n\t<td class=\"nomobile\">";
			echo $languages[$result['language']];
		echo "</td>";
		echo "\n\t<td class=\"notablet\">";
			echo $result['userID'];
		echo "</td>";
		echo "\n\t<td class=\"notablet\">";
			echo date('d/m/Y', strtotime($result['created']));
		echo "</td>";
	echo "\n</tr>";
}

function endPostsTable() {
	echo "\n</table>";
}

?>