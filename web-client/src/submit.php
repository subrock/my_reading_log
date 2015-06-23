<?

if ($_POST['Minutes']) {

// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

$entry_date=$_POST['Date'];
$entry_title=$_POST['Title'];
$entry_author=$_POST['Author'];
$entry_genre=$_POST['Genre'];
$entry_complete=$_POST['Complete'];
$entry_start=$_POST['Start'];
$entry_end=$_POST['End'];
$entry_minutes=$_POST['Minutes'];

// Global db connect
mysql_connect($db_host,$db_user,$db_password);
@mysql_select_db($db_name) or die( "Unable to select database");

$query="INSERT INTO EntryTable (entry_reader_id,entry_date,entry_title,entry_author,entry_genre,entry_complete,entry_start,entry_end,entry_minutes) VALUES ($rid,'$entry_date','$entry_title','$entry_author','$entry_genre','$entry_complete',$entry_start,$entry_end,$entry_minutes) ";
$result=mysql_query($query);
setcookie("message","Entry has been added successfully.", time() + 30, '/');
header('Location: ./');


}
?>




