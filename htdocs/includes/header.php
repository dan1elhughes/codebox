<?php
require "settings.php";
require "functions.php";

if(!isset($_SESSION['username']) && !((basename(dirname($_SERVER['PHP_SELF'])) == "login") || (basename(dirname($_SERVER['PHP_SELF'])) == "register"))) {header ("location: $rootpath" . "login/");}

$navigationlinks['About'] = "about";

if (isset($_SESSION['username'])) {
$username = $_SESSION['username'];
$navigationlinks['All'] = 'posts';
$navigationlinks['My Posts'] = 'posts/mine';
if (isAdmin()) {$navigationlinks['Admin'] = 'admin/logs';}
$navigationlinks["<i class=\"fa fa-caret-down\"></i>"] = 'logout';
}

$languages = array (
	"bsh"=>"Bash",
	"c"=>"C",
	"cpp"=>"C++",
	"cs"=>"C#",
	"css"=>"CSS",
	"html"=>"HTML",
	"java"=>"Java",
	"js"=>"JavaScript",
	"perl"=>"Perl",
	"py"=>"Python",
	"rb"=>"Ruby",
	"xhtml"=>"XHTML",
	"xml"=>"XML"
);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<link href="<?php echo $rootpath;?>includes/style.css" rel="stylesheet" type="text/css" />

		<link rel="icon" type="image/png" href="<?php echo $rootpath;?>images/logo.png" />
		<link rel="apple-touch-icon" href="<?php echo $rootpath;?>images/logo.jpg" />

		<link rel="author" href="https://plus.google.com/100101734729968276703/"/>

		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

		<link href="<?php echo $rootpath;?>includes/prettify/prettify.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo $rootpath;?>includes/prettify/prettify.js"></script>

		<link href="<?php echo $rootpath;?>includes/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Dan Hughes">
		<meta name="description" content="Home of a web designer, session musican, DJ and gamer.">

		<meta property="og:image" content="<?php echo $rooturl.$rootpath;?>images/logo.jpg" />
		<meta property="og:title" content="Codebox" />
		<meta property="og:description" content="A place to share code of many languages. Currently in private beta." />
		<meta property="og:url" content="<?php echo $rooturl.$rootpath;?>" />
		
		<title>&lt;CODEBOX&gt;</title>
	</head>
	<body onload="prettyPrint()">
		<nav>
		<a id="title" href="<?php echo $rootpath;?>">&lt;CODE<span>BOX</span>&gt;</a>
			<ul><?php
				foreach ($navigationlinks as $k => $v) {
					echo "\n\t\t\t\t<li><a href=\"".$rootpath.$v."\">$k</a></li>";
				}
				echo "\n";?>
			</ul>
		</nav>
	<div id="content">
	