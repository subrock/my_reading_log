<?php

// Pull Reader ID from GET
$rid=$_GET['id'];

// Get Reader Info from XML
function GetReaderInfo ($id) {
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";
$xml = "<?xml version='1.0' standalone='yes'?>";
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db('MY_READING_LOG') or die( "For some reason I am unable to select database");
        $query="select * from ReaderTable where reader_id=".$id;
        $result=mysql_query($query);
	$num=mysql_numrows($result);
	$i=0;
	while ($i < $num) {
		$xml = $xml . "<reader>";
		$xml = $xml . "<reader_name>".mysql_result($result,$i,"reader_name")."</reader_name>";
		$xml = $xml . "<reader_email>".mysql_result($result,$i,"reader_email")."</reader_email>";
		$xml = $xml . "</reader>";
	$i++;
	}

return $xml;
}

// Response body
header("Content-type: text/xml");
echo GetReaderInfo($rid);


?>

