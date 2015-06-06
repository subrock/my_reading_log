<html>
<head>
<title></title>
<style>
        body {margin:20px 20px;}
        td {
                        border-style:solid dashed dashed dashed;
                        border-color: silver;
                        border-width:1px;
        }


</style>
</head>
<body onload="window.print();">
<?php

$total_pages_read=0;
$total_minutes_read=0;
$pin_pages_read=0;
$pin_minutes_read=0;

$start_date="2014-02-27";
if ($_GET['pin'] != "") {
        $start_date=$_GET['pin'];
}

$andfilter="";
$fi="";
if ($_GET['filter'] != "") {
        $andfilter=" and Author=".$_GET['filter']."";
        $fi=$_GET['filter'];
}


function get_first_date()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
	$query="select Date from entry_table order by Date limit 1";
	$result=mysql_query($query);
        $start=mysql_result($result,0,"Date");
	return $start;
}

function total_minutes_page($total_minutes_read,$total_pages_read)
{
	$total_minutes_page=($total_minutes_read / $total_pages_read);
	$total_minutes_page=number_format($total_minutes_page, 2, '.', '');
	return $total_minutes_page;
}

function pin_minutes_page($minutes_read,$pages_read)
{
        $pin_minutes_page=($minutes_read / $pages_read);
        $pin_minutes_page=number_format($pin_minutes_page, 2, '.', '');
        return $pin_minutes_page;
}


function total_cols($column)
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
	$query="select DISTINCT ".$column." from entry_table where Complete <> ''";
        $result=mysql_query($query);
	$num=mysql_numrows($result);
	return $num;
}

function pin_cols($column)
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select DISTINCT ".$column." from entry_table where Complete <> '' and Date > '".$GLOBALS['start_date']."' ".$GLOBALS['andfilter'];
        $result=mysql_query($query);
        $num=mysql_numrows($result);
        return $num;
}


function totalPages($record)
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
	$rtn = ($end - $start)+1;
        return $rtn;
 }

function pin_pages_read()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select * from entry_table where Date > '".$GLOBALS['start_date']."' ".$GLOBALS['andfilter'];
	$result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {
$pin_pages_read=$pin_pages_read + totalPages(mysql_result($result,$i,"entry_id"));
$i++;

}

        return $pin_pages_read;
 }

function total_pages_read()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select * from entry_table";
        $result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {
$total_pages_read=$total_pages_read + totalPages(mysql_result($result,$i,"entry_id"));
$i++;

}

        return $total_pages_read;
 }


function total_minutes_read()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select * from entry_table";
        $result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {
$total_minutes_read=$total_minutes_read + mysql_result($result,$i,"Minutes");
$i++;

}

        return $total_minutes_read;
 }

function pin_minutes_read()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("reading_db") or die( "Unable to select database");
        $query="select * from entry_table where Date > '".$_GET['pin']."' $andfilter";
        $result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {
$total_minutes_read=$total_minutes_read + mysql_result($result,$i,"Minutes");
$i++;

}

        return $total_minutes_read;
 }


function convertToHoursMins($time, $format = '%d:%d') {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


// define table information here.
$table_name="entry_table";
$fields=array("entry_id","Date","Title","Author","Level","Genre","Complete","Start","End","Minutes");
$arrlength=count($fields);

// http://www.amazon.com/s/ref=nb_sb_ss_c_0_11?url=search-alias%3Dstripbooks&field-keywords=mike+lupica&sprefix=mike+lipica%2Caps%2C217&rh=n%3A283155%2Ck%3Amike+lupica
        echo "<b>The Student's Electronic Reading Log</b><hr>Reading History<br><Br>";

echo "<table class=dashed border=0 cellspacing=0 cellpadding=2 width=100%>";
for($x=1;$x<$arrlength;$x++)
  {
  // echo "<th><a href=".$_SERVER['PHP_SELF']."?orderby=".$fields[$x].">".$fields[$x]."</a></th>";
  echo "<th align=left><font size=-1>".$fields[$x]."</th>";
  fwrite($fh, $fields[$x].",");
  }
 echo "<th width=10>Pages</th><tr>";

//include 'functions.php';
mysql_connect("localhost","root","testme");
@mysql_select_db("reading_db") or die( "Unable to select database");
$query="SELECT * FROM entry_table order by Date";
$query="SELECT * FROM ".$table_name." where Date > '$start_date' $andfilter ";
$result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {

        //fwrite($fh, "\n");
for($x=1;$x<$arrlength;$x++)
        {
echo "<td>".mysql_result($result,$i,$fields[$x])."</td>";
        //fwrite($fh, mysql_result($result,$i,$fields[$x]).",");
        }
echo "<td>".totalPages(mysql_result($result,$i,'entry_id'))."</td></tr>";
$i++;

}


echo "</table>";
if ($_GET['pin'] || $_GET['filter']) {
echo "<Br><hr size=0 color=black><b>Pin/Filter Details:</b><Br><Br>";
echo "The PIN start date is <b>".$start_date."</b>.<Br>";
if ($_GET['filter']) {
	echo "Author Filter has been set to <b>".$_GET['filter']."</b>.<Br>";
}
echo "The Student has read a total of <b>".pin_pages_read()."</b> page(s) in this period.<Br>";
echo "In this period the Student has read for a total of <b>".convertToHoursMins(pin_minutes_read(), '%02d hours %02d minutes')."</b>. (That's a total of ".pin_minutes_read()." minutes.)<Br>";
echo "This translates into <b>".pin_minutes_page(pin_minutes_read(),pin_pages_read())."</b> minutes per page.<Br>";
if ($_GET['filter']) {
	echo "Since ".$start_date." the Student has completed reading from a total of <b>".pin_cols("Title")."</b> book(s) from ".$_GET['filter'].".<Br>";
} else {
	echo "Since ".$start_date." the Student has completed reading from a total of <b>".pin_cols("Title")."</b> book(s).<Br>";
	echo "Since ".$start_date." the Student has completed reading from <B>".pin_cols("Author")."</b> different author(s).";
}

}

echo "<Br><Br>";
echo "<hr size=0 color=black><b>Total Reading Details:</b><br><Br>";
echo "The Student started this reading log on <b>".get_first_date()."</b>.<Br>";
echo "The Student has read a total of <b>".total_pages_read()."</b> page(s).<Br>";
echo "The Student has read for a total of <b>".convertToHoursMins(total_minutes_read(), '%02d hours %02d minutes')."</b>. (That's a total of ".total_minutes_read()." minutes.)<Br>";
echo "This translates into <b>".total_minutes_page(total_minutes_read(),total_pages_read())."</b> minutes per page.<Br>";
echo "The Student has completed reading from a total of <b>".total_cols("Title")."</b> book(s).<Br>";
echo "The Student has completed reading from <B>".total_cols("Author")."</b> different author(s).";
?>
<br><br>
<center><i><font size=-1>http://jerome.lendmyvoice.org/reading_log</i></center>
</body>
</html>
