<?php
$rootpath="/workshop/codebox/";
//$filepath="/home/linweb21/d/danhughes.me/user/htdocs";

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 'On');

date_default_timezone_set('Europe/London');

$dbIP = "localhost";
$dbUsername = "dbedit";
$dbPassword = ($devMode ? "localpassword" : "remotepassword");
$dbTable = "codebox";

$dbedit=mysqli_connect($dbIP,$dbUsername,$dbPassword,$dbTable) or die(mysqli_error($dbedit));
if (mysqli_connect_errno()) { echo mysqli_connect_error(); }

$dbUsername = "dbview";
$dbPassword = ($devMode ? "localpassword" : "remotepassword");

$dbview=mysqli_connect($dbIP,$dbUsername,$dbPassword,$dbTable) or die(mysqli_error($dbview));
if (mysqli_connect_errno()) { echo mysqli_connect_error(); }
?>