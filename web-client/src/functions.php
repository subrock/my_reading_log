<?
// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

// Global db connect
mysql_connect($db_host,$db_user,$db_password);
@mysql_select_db($db_name) or die( "Unable to select database");


// Global Functions

function totalPagesAll($record)
{
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function toalPagesPin($record)
{
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function setAuthenticationCookie($reader_id) {
	setcookie("MY_READING_LOG","$reader_id");
}

function lookupreadername($id) {
        $query="select reader_name from ReaderTable where reader_id=".$id;
        $result=mysql_query($query);
        $reader_name=mysql_result($result,0,"reader_name");
	return $reader_name;
}


?>
