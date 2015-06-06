<? include 'functions.php'; ?>
<?

// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

//echo $_COOKIE['MY_READING_LOG'];
if (!$_COOKIE['MY_READING_LOG']) {
	header('Location: ./login.php');
	//echo "<a href=login.php>Login</a>";
	exit;
}
// Server Side Scripting

if (!$_GET['orderby']) {
        $orderby="Date ASC";
} else {
        $orderby=$_GET['orderby'];
}


// Table fields
$fields=array("entry_id","Date","Title","Author","Level","Genre","Complete","Start","End","Minutes");
$arrlength=count($fields);

// Insert a new entry.
if ($_POST['new_value'][1]) {
$newsql="''";

for($x=0;$x<$arrlength-1;$x++)
  {
        $newsql = $newsql.",'".$_POST['new_value'][$x]."'";
  }

$query="INSERT INTO entry_table VALUES (".$newsql.")";
if (!mysql_query($query))
   {
     echo "<Br>" . mysql_error();
     exit();
   }
} // end if $_POST['new_value']


?>

<html>
<head>
<title>My Reading Log</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="javascript.js"></script>
</head>
<body onload="load()">


Currently logged in as user ID <? echo $_COOKIE['MY_READING_LOG']; ?>. Also known as <? echo lookupreadername($_COOKIE['MY_READING_LOG']); ?>.


<Br><Br>
<a href=logout.php>Logout</a>

</body>
</html>




