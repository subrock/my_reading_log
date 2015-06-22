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
                setcookie("message","Registration faild. $res", time() + 30, '/');
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
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Enter your name, password and email to register.<Br><Br>

Name<Br>
<input type=text name=reader_name size=30 autocomplete="off"><Br>

Password<br>
<input type=password name=reader_password size=30 autocomplete="off"><Br>
Email<br>
<input type=text name=reader_email size=30 autocomplete="off"><Br><Br>

<input type=submit value="Continue"> <a href=login.php>Or login here.</a>
</form>

<?
// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><font face=verdana color=blue size=-1><? echo $_COOKIE['message']; ?></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>


</body>
</html>

<?
} // End check for login post.
?>
