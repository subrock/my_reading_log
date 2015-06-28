<?

include './settings.php';
$logname=$_COOKIE['logname'];
if ($logname == "") {
	$logname="My Reading Log";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include './functions.php';
	$reg_user=$_POST['reader_name'];
	$reg_pass=$_POST['reader_password'];

$postdata = http_build_query(
    array(
        'signiture' => $api_key,
        'user' => $reg_user,
        'password' => $reg_pass
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);

	$homepage = file_get_contents($api_url."/AuthenticateUser/",false,$context);
	try {
  		$sxe = new SimpleXMLElement($homepage);
	} catch (Exception $e) {
  		echo "An Error Occured. Usually no XML response. Which means Key failed or error with the API url.<Br>";
  		exit;
	} // End XML check/error.

	$res = $sxe->{"result"};
	$reader_id = $sxe->{"id"};
	$reg_user = $sxe->{"name"};
	if ($res == "Sucess") {
                setAuthenticationCookie($reader_id);
                setcookie("message","Authentication successful.", time() + 30, '/');
                setcookie("logname",$reg_user, time() + 3000, '/');
		header('Location: ./');	
	} else {
		$res = $sxe->{"reason"};
                setcookie("message","Authentication faild. $res", time() + 30, '/');
		header('Location: ./login.php');
	}
} else { // If no login post, display registration page.

?>


<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src=jquery.min.js></script>
<script src="javascript.js"></script>
</head>
<body  style="margin:10;padding:10" alink=silver vlink=white link=white bgcolor=#303030>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table id=display_table cellspacing=0 cellpadding=25 bgcolor=white><th>
Enter your special secret to authenticate.</th>
<tr><td>

Name of your reading log<Br>
<input type=text name=reader_name size=30 autocomplete="off" value="<? echo $logname; ?>"><Br>

Password of your choosing<br>
<input type=text name=reader_password size=30 autocomplete="off" value="password" onFocus="this.setSelectionRange(0, this.value.length)" autofocus><Br>

</td></tr></table>
<Br><input class=btn type=submit value="Authenticate"> <a href=register.php>Or register here.</a>
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
