

<? include 'functions.php'; ?>
<?

// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";


// Process registration or login information.
if ($_POST['reader_password']) {
$pn=$_POST['reader_name'];
$pp=$_POST['reader_password'];
mysql_connect($db_host,$db_user,$db_password);
@mysql_select_db($db_name) or die( "Unable to select database");
        $query="select * from ReaderTable where reader_name='".$_POST['reader_name']."' and reader_password='".$_POST['reader_password']."'";
        $result=mysql_query($query);
	$rp=mysql_result($result,0,"reader_password");
	$rn=mysql_result($result,0,"reader_name");
	if ($rn==$pn || $rp==$pp) {
                $reader_id=mysql_result($result,0,"reader_id");
                setAuthenticationCookie($reader_id);
                //echo "Authentication sucessful.<Br><Br> <a href=./>Continue...</a>";
                header('Location: ./');
                exit;
	} else {
		echo "Login failed. <Br><Br><a href=login.php>Try again.</a>";
    		//die('Could not query:' . mysql_error());
                //header('Location: ./');
		exit;
	}
}

?>


<html>
<head>
<title>My Reading Log - Login</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="javascript.js"></script>
</head>
<body>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Enter your name and password or register a new account.<Br><Br>
Name<Br>
<input type=text name=reader_name size=30><Br><Br>
Password<br>
<input type=text name=reader_password size=30><Br><Br>
<Br>
<input type=submit value="Continue"><Br><Br>
<a href=register.php>Or register here.</a>
</form>

