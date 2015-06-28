<?

include '../settings.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Set API cookie here.
$api_uri=$_POST['api_uri'];
setcookie("api_uri",$api_uri,time()+3600,"/");
setcookie("message","API URI has been set to;<Br>".$api_uri, time() + 30,"/");
header('Location: ../logout.php');
} else { // If no selection display options.

?>


<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../stylesheet.css">
<script src=../jquery.min.js></script>
<script src="../javascript.js"></script>
</head>
<body  style="margin:10;padding:10" alink=silver vlink=white link=white bgcolor=#303030>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table id=display_table cellspacing=0 cellpadding=25 bgcolor=white><th>
Select an API server to point to.</th>
<tr><td>
API Destination URL:<br>
<select name=api_uri>
<option><? echo $api_url; ?></option>
<option>http://read.lendmyvoice.net/api/v2</option>
<option>http://jerome.lendmyvoice.org/my-reading-log/api/v2</option>

</td></tr></table>
<Br><input class=btn type=submit value="Save"> 
</form>

<?
// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><font face=verdana color=red size=2><b><? echo $_COOKIE['message']; ?></b></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>


</body>
</html>

<?
} // End check for login post.
?>
