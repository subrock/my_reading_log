

<? include functions.php; ?>
<?
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

//var_dump($_POST);
// Process registration or login information.
if ($_POST['reader_name'] || $_POST['reader_password']) {
	mysql_connect($db_host,$db_user,$db_password);
	@mysql_select_db($db_name) or die( "Unable to select database");
        $query="select * from ReaderTable where reader_name=".$_POST['reader_name'];
        $result=mysql_query($query);
        if ($result) {
                echo "Reader with that name already exists.";
        } else {
                $tmpsql="'','".$_POST['reader_name']."','".$_POST['reader_password']."','".$_POST['reader_email']."'";
                $query="INSERT INTO ReaderTable VALUES (".$tmpsql.")";
		//echo $query;
                $result=mysql_query($query);
		if (!$result) {
    			die('Could not query:' . mysql_error());
		}
		echo "Registration is complete.<Br><Br><a href=./login.php>Continue...</a>";
		//header('Location: ./login.php');
		exit;
        }
}
?>

<html>
<head>
<title>My Reading Log - Registration</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="javascript.js"></script>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Enter your name, password and email to register a new account.<Br><Br>
Name<Br>
<input type=text name=reader_name size=30><Br><Br>
Password<br>
<input type=text name=reader_password size=30><Br><Br>
Email (Optional)<br>
<input type=text name=reader_email size=30><Br><Br>

<input type=submit value="Continue">
<Br><Br>
<a href=./>Or login here.</a>
</form>

