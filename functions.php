<?
// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="my_reading_log";


// Global Functions

function totalPagesAll($record)
{
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db($db_name) or die( "Unable to select database");
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function toalPagesPin($record)
{
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db($db_name) or die( "Unable to select database");
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }



?>
