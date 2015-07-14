<?

if ($_POST['conv']) { 
echo "Starting conversion.";
mysql_connect("localhost","root","testme");
@mysql_select_db("MY_READING_LOG") or die( "Unable to select database ").".";
$query="SELECT * from EntryTable where entry_reader_id=".$_POST['user1'];
$result=mysql_query($query);
$num=mysql_numrows($result);
$r=0;
while ($r < $num) {

$entry_id=mysql_result($result,$r,"entry_id");
$entry_reader_id=$_POST['user2'];
$Date=mysql_result($result,$r,"entry_date");
$Title=mysql_result($result,$r,"entry_title");
$Author=mysql_result($result,$r,"entry_author");
$Level=mysql_result($result,$r,"entry_level");
$Genre=mysql_result($result,$r,"entry_genre");
$Complete=mysql_result($result,$r,"entry_complete");
$Start=mysql_result($result,$r,"entry_start");
$End=mysql_result($result,$r,"entry_end");
$Minutes=mysql_result($result,$r,"entry_minutes");


echo "<Br>Converting record $entry_id.";

@mysql_select_db("MY_READING_LOG") or die( "Unable to select database ").".";
$query2="INSERT INTO EntryTable VALUES ('',$entry_reader_id,'$Date','$Title','$Author','$Level','$Genre','$Complete','$Start','$End','$Minutes','')";
echo $query2."<Br>";
$result2=mysql_query($query2);







$r++;

}
echo "<br> Complete.";
exit;
}
?>


<html>
<head>
<title></title>
</head>
<body>

<form name="convert" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Reader ID from <input name=user1 type=text size=5> to <input name=user2 type=text size=5> 
<input name=conv type=submit value=Convert>
</form>
<Br>





</body>
</html>


