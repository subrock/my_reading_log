<?


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include './functions.php';
	include './settings.php';
	$reg_user=$_POST['reader_name'];
	$reg_pass=$_POST['reader_password'];
	$reg_mail=$_POST['reader_email'];

$postdata = http_build_query(
    array(
        'signiture' => $api_key,
        'user' => $reg_user,
        'password' => $reg_pass,
        'email' => $reg_mail
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

	//$homepage = file_get_contents($api_url."/RegisterUser/?signiture=".urlencode($api_key)."&user=$reg_user&password=$reg_pass&email=$reg_mail",false,$context);
	$homepage = file_get_contents($api_url."/RegisterUser/",false,$context);
	try {
  		$sxe = new SimpleXMLElement($homepage);
	} catch (Exception $e) {
  		echo "An Error Occured. Usually no XML response. Which means Key failed or error on API side.";
  		exit;
	} // End XML check/error.

	$res = $sxe->{"result"};
	$reader_id = $sxe->{"id"};

	if ($res == "Sucess") {
                setAuthenticationCookie($reader_id);
                setcookie("message","Registration successful.", time() + 30, '/');
		header('Location: ./');	
	} else {
		$res = $sxe->{"reason"};
                setcookie("message","Registration failed. $res", time() + 30, '/');
		header('Location: ./register.php');
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
Enter your name, password and email to register.</th>
<tr><td>
What will be the name of your log?<Br>
<input type=text name=reader_name size=30 value="My Reading Log" autocomplete="off"><Br>

Can you tell me a secret we both can remember?<br>
<input type=text name=reader_password size=30 value="password" autocomplete="off"><Br>
Email<br>
<input type=text name=reader_email size=30 autocomplete="off">
</td></tr></table>
<Br>
<input class=btn type=submit value="Register"> <input class=btn type=button value="Or Login" onClick="window.location='login.php'">
</form>

<?
// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><font face=verdana color=red size=2><B><? echo $_COOKIE['message']; ?></b></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>


</body>
</html>

<?
} // End check for login post.
?>
