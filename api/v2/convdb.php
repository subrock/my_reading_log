<?

if ($_POST['conv']) { 
echo "Starting conversion.";
mysql_connect("localhost","root","testme");
@mysql_select_db("reading_db") or die( "Unable to select database ").".";
$query="SELECT * from entry_table";
$result=mysql_query($query);
$num=mysql_numrows($result);
$r=0;
while ($r < $num) {

$entry_id=mysql_result($result,$r,"entry_id");
$Date=mysql_result($result,$r,"Date");
$Title=mysql_result($result,$r,"Title");
$Author=mysql_result($result,$r,"Author");
$Level=mysql_result($result,$r,"Level");
$Genre=mysql_result($result,$r,"Genre");
$Complete=mysql_result($result,$r,"Complete");
$Start=mysql_result($result,$r,"Start");
$End=mysql_result($result,$r,"End");
$Minutes=mysql_result($result,$r,"Minutes");


echo "<Br>Converting record $entry_id.";

@mysql_select_db("MY_READING_LOG") or die( "Unable to select database ").".";
$query2="INSERT INTO EntryTable VALUES ($entry_id,1,'$Date','$Title','$Author','$Level','$Genre','$Complete','$Start','$End','$Minutes','')";
$result2=mysql_query($query2);







$r++;

}
}
echo "Complete.";
?>


<html>
<head>
<title></title>
</head>
<body>

<form name="convert" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input name=conv type=submit value=Convert>
</form>





</body>
</html>


