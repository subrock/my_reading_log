
<?php


// page counter based on server session.

   session_start();
   if( isset( $_SESSION['counter'] ) )
   {
      $_SESSION['counter'] += 1;
   }
   else
   {
      $_SESSION['counter'] = 1;
   }
   $msg = "You have visited this page ".  $_SESSION['counter'];
   $msg .= "in this session.";
   $msg = $_SESSION['counter'];


//var_dump($_POST['new_value']);
#print_r($_POST);

function totalPages($record)
{
	mysql_connect("localhost","root","testme");
	@mysql_select_db("reading_db") or die( "Unable to select database");
	$query="select * from entry_table where entry_id=".$record;
	$result=mysql_query($query);
	$start=mysql_result($result,0,"Start");
	$end=mysql_result($result,0,"End");
	$rtn = ($end - $start) + 1;
	return $rtn;
 }



if (!$_GET['orderby']) {
	$orderby="Date ASC";
} else {
	$orderby=$_GET['orderby'];
}

// define table information here.
$table_name="entry_table";



if ($_GET['remove']) {

$sql="DELETE FROM $table_name WHERE entry_id = ".$_GET['remove'];
//echo $sql."<br>";
$con=mysqli_connect("localhost","root","testme","reading_db");
 // Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
 if (!mysqli_query($con,$sql))
   {
   die('Error: ' . mysqli_error($con));
   }
 //echo "1 record removed<br>";



}


// define table information here.
$table_name="entry_table";
$fields=array("entry_id","Date","Title","Author","Level","Genre","Complete","Start","End","Minutes");
$arrlength=count($fields);
// end table info

 //   echo htmlspecialchars($tag)."<br>";
//foreach($_POST as $key => $value) {
//var_dump($_POST);
	//echo "<Br><b>".$key."</b><br><pre>".var_dump($value)."</pre><Br>";
  //  } 


if ($_POST['update']) {
//	echo "<font color=red>Data has been updated.</font>";
//	echo "<Br>";
// findme
//echo "test";
mysql_connect("localhost","root","testme");
@mysql_select_db("reading_db") or die( "Unable to select database");
$query="select entry_id from entry_table";
if (!mysql_query($query))
   {
     echo "There is a technical problem at this moment please contact live support" . mysql_error();
     exit();
   }
$result=mysql_query($query);
$num=mysql_numrows($result);
$r=0;
while ($r < $num) {
$entry_id=mysql_result($result,$r,"entry_id");
//echo $entry_id." = ".$_POST['Date'.$entry_id]."<br>";
//echo $entry_id."[".$r."] = ";
//$test=mysql_result($result,$r,"entry_id");
//echo $entry_id."<br>";
$a = $_POST['Date'.$entry_id];
$b = $_POST['Title'.$entry_id];
$c = $_POST['Author'.$entry_id];
$d = $_POST['Level'.$entry_id];
$e = $_POST['Genre'.$entry_id];
$f = $_POST['Complete'.$entry_id];
$g = $_POST['Start'.$entry_id];
$h = $_POST['End'.$entry_id];
$j = $_POST['Minutes'.$entry_id];
//echo $entry_id."<br>";
//echo "<pre>";
//echo $r . " = " . $entry_id;
//echo '<Br>Date'.$entry_id.' = '.$a;
//echo "</pre>";
#$query2="UPDATE $table_name SET Date = STR_TO_DATE('$a','%d,%m,%Y'), Title = '$b', Author = '$c', Level = '$d', Genre = '$e', Complete = '$f', Start = '$g', End = '$h', Minutes = '$j', entry_date='$a' WHERE entry_id = $entry_id";

$datetime = $a; 
$yyyy = substr($datetime,6,9);
$mm = substr($datetime,0,2);
$dd = substr($datetime,3,2);

$rrrr="'".$yyyy."-".$mm."-".$dd."'";
//echo $rrrr."<br />";
$query2="UPDATE $table_name SET Date = '".$a."', Title = '$b', Author = '$c', Level = '$d', Genre = '$e', Complete = '$f', Start = '$g', End = '$h', Minutes = '$j' WHERE entry_id = $entry_id";
//$query2="UPDATE $table_name SET Date = ".$rrrr.", Title = '$b', Author = '$c', Level = '$d', Genre = '$e', Complete = '$f', Start = '$g', End = '$h', Minutes = '$j', entry_date='$a' WHERE entry_id = $entry_id";
//echo $query2."<br>";

$result2=mysql_query($query2);
$r++;

}

//var_dump($_POST['new_value']);
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

//$result=mysql_query($query);


} // end if $_POST['new_value']

  }
 
?>


<html>
<head>
<style>


#display_table
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#display_table td, #display_table th
{
font-size:1em;
border:1px solid #98bf21;
border:1px solid #084B8A;
padding:3px 7px 2px 7px;
width:50px;
}
#display_table th
{
font-size:1.1em;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#A7C942;
background-color:#045FB4;
color:#ffffff;
}
#display_table tr.alt td
{
color:#000000;
background-color:#EAF2D3;
}
#input[type="text"] {width: 100%;} 

tr:hover {    
	background: #B0B0B0 !important; 
}

</style>

<SCRIPT TYPE="text/javascript">
<!--
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")

</script>

<SCRIPT TYPE="text/javascript">
function fill(from,to) {
var x = document.getElementById(from).value;
document.getElementById(to).value=x;
alert("I am an alert box!");
}


// -->
</SCRIPT>

</head>
<script type="text/javascript">
function load() {
window.scrollTo(0, document.body.scrollHeight);  
}
</script>


<body onload="load()">
<font size=+3><img src=jerome.jpg border=0 width=34 height=25>Jerome's Reading Log </font><hr>

<form name="update" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table id=display_table cellspacing=0 cellpadding=2>
<?php
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

$myFile = "tmp";
//$fh = fopen($myFile, 'w');


for($x=1;$x<$arrlength;$x++)
  {
  // echo "<th><a href=".$_SERVER['PHP_SELF']."?orderby=".$fields[$x].">".$fields[$x]."</a></th>";
  echo "<th>".$fields[$x]."</th>";
  //fwrite($fh, $fields[$x].",");
  }
 echo "<th width=10>Pages</th><th>Tools</th>";
//include 'functions.php';
mysql_connect("localhost","root","testme");
@mysql_select_db("reading_db") or die( "Unable to select database");

$query="SELECT * FROM ".$table_name." where Date > '$start_date' $andfilter  order by ".$orderby;
//echo $query;
$result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {

	echo "<tr>";
	//fwrite($fh, "\n");
for($x=1;$x<$arrlength;$x++)
	{

//echo  $fields[$x].mysql_result($result,$i,'entry_id')."<br>";

?>
<Td width=10>
<input onChange="this.style.color='red'" type='text' name="<?php echo $fields[$x]; ?><?php echo mysql_result($result,$i,'entry_id'); ?>" size=10 value="<?php echo mysql_result($result,$i,$fields[$x]); ?>" style='border: none; width: 100%'>
<input type=hidden name=record_name[] value="<?php echo $fields[$x]; ?>">
<input type=hidden name=record_id[] value="<?php echo  mysql_result($result,$i,0); ?>">
</td>
<?php
	//fwrite($fh, mysql_result($result,$i,$fields[$x]).",");
	}

echo "<td>".totalPages(mysql_result($result,$i,'entry_id'))."</td><td width=10><font size=-1><a href=./?pin=".mysql_result($result,$i,'Date')."&filter=".urlencode($fi).">PIN</a> | <a href=./?filter='".urlencode(mysql_result($result,$i,'Author'))."'&pin=".$_GET['pin'].">Filter</a></td>";
if ($_GET['admin'] == "true") {
	echo "<td width=1 align=center><a href=".$_SERVER['PHP_SELF']."?remove=".mysql_result($result,$i,0).">remove</a></td>";
} // end if ($_POST['admin'])
echo "</tr>";
$lastrecord=mysql_result($result,$i,'entry_id');
$i++;
}
?>
<tr><td><input onChange="this.style.color='red'" value='<?php echo date("Y-m-d", time() - 60 * 60 * 24); ?>' type='text' name="new_value[]" size=10 value="" style='border: none; width: 100%'></td>
<?php
for($x=2;$x<$arrlength;$x++)
        {
?>
<td>
<input ondblclick="this.value='document.getElementById('<?php echo $fields[$x].$lastrecord; ?>').value'test"  onChange="this.style.color='red'" type='text' name="new_value[]" size=10 value="" style='border: none; width: 100%'>
</td>
<?php
}
echo "</tr>";
//fclose($fh);

?>
</table>
<Br>

<? 
if (!$_GET['pin'] && !$_GET['filter']) {
?>
<input name=update type=submit value="Save Any Changes"> 
<input type=reset value="Refresh Data">
<? } ?>

<input type=button value="Refresh Page" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>'">
<input type=button value="Print Data" onclick="window.open('report_totals.php?pin=<? echo $_GET['pin']; ?>&filter=<? echo urlencode($_GET['filter']); ?>', 'Print', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,scrollbars=1,width=1000,height=600');return false";" >
<?
if (!$_GET['pin'] && !$_GET['filter']) {
?>

<input type=button value="Forms" onClick="window.location='forms/'">
<input type=button value="Backup DB" onClick="window.location='backup.php'">
<input type=button value="Remove Row" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?admin=true'">
<? } ?>
</form>
Pin Date: <? echo $start_date; ?><Br>
Author Filter: <? echo $_GET['filter']; ?>
<Br><br>
Records: <? echo $num; ?>
</body>
</html>

