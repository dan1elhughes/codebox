<?php include "../includes/header.php";
if (!isset($_GET['p'])) {
header ('location: ./all/');
}

$votes = getVotes();

$postID = mysqli_real_escape_string($dbview, $_GET['p']);
$query = mysqli_query($dbview, "SELECT * FROM posts WHERE charID = '$postID'");
$result = mysqli_fetch_array($query);
$count = mysqli_num_rows($query);

if ($count == 0) {
	echo "Post not found.";
}
else if (((($result['privacy'] == 1) || ($result['privacy'] == 2)) && ($result['userID'] != $_SESSION['ID'])) && !isAdmin()) {
	echo "Post is private.";
}
else {
	post($result, $votes);
	?>
		<hr/>
		<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'yourcodebox'; // required: replace example with your forum shortname
		var disqus_identifier = '<?php echo $result['charID'];?>';
		var disqus_title = '<?php echo addslashes(htmlspecialchars($result['title']));?>';
		var disqus_url = '<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>';

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments.</a></noscript>    
	<?php
}?>
<? include "../includes/footer.php"; ?>