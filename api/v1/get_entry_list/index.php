<?php

function totalPages($start,$end)
{
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function GetEntryList () {
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";
$rid=$_COOKIE['MY_READING_LOG'];
$rid=1;
$xml = "<?xml version='1.0' standalone='yes'?>";
$xml = $xml . "<entry reader_id='$rid'>";
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db('MY_READING_LOG') or die( "For some reason I am unable to select database");
        $query="select * from EntryTable where entry_reader_id=".$rid;
        $result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$xml = $xml . "<book>";
$xml = $xml . "<date>".mysql_result($result,$i,"entry_date")."</date>";
$xml = $xml . "<title>".mysql_result($result,$i,"entry_title")."</title>";
$xml = $xml . "<author>".mysql_result($result,$i,"entry_author")."</author>";
$xml = $xml . "<genre>".mysql_result($result,$i,"entry_genre")."</genre>";
$xml = $xml . "<complete>".mysql_result($result,$i,"entry_complete")."</complete>";
$xml = $xml . "<start>".mysql_result($result,$i,"entry_start")."</start>";
$xml = $xml . "<end>".mysql_result($result,$i,"entry_end")."</end>";
$xml = $xml . "<minutes>".mysql_result($result,$i,"entry_minutes")."</minutes>";
$xml = $xml . "<pages>".totalPages(mysql_result($result,$i,'entry_start'),mysql_result($result,$i,'entry_end'))."</pages>";
$xml = $xml . "</book>";
$i++;
}
$xml = $xml . "</entry>";

return $xml;

}

header("Content-type: text/xml");
echo GetEntryList();
//echo "<textarea rows=8 cols=100>".GetEntryList()."</textarea><br><br>";


function ProcessQuery () {
$xml = simplexml_load_string($string);
print_r($xml);
$login = $xml->login;
print_r($login);
$login = (string) $xml->login;
print_r($login);
}

?>

