<?php



// Authentication 
if (!$_COOKIE['MY_READING_LOG']) {
        header('Location: ./login.php');
        exit;
} else {
	$rid=$_COOKIE['MY_READING_LOG'];
}


$aso=$_GET['aso'];

// When was the log started?
function get_first_date()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("MY_READING_LOG") or die( "Unable to select database");
        $query="select * from EntryTable order by entry_date limit 1";
        $result=mysql_query($query);
        $start=mysql_result($result,0,"entry_date");
        return $start;
}

// Total number of pages of a specific record. 
function totalPages($record)
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("MY_READING_LOG") or die( "Unable to select database");
        $query="select * from EntryTable where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"entry_start");
        $end=mysql_result($result,0,"entry_end");
        $rtn = ($end - $start)+1;
        return $rtn;
 }

// Add up all the total_pages and you get_total_page read.
function total_pages_read()
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("MY_READING_LOG") or die( "Unable to select database");
        $query="select * from EntryTable";
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

// Total minutes needed to read a page.
function total_minutes_page($total_minutes_read,$total_pages_read)
{
        $total_minutes_page=($total_minutes_read / $total_pages_read);
        $total_minutes_page=number_format($total_minutes_page, 2, '.', '');
        return $total_minutes_page;
}

//Total of a paticular column.
function total_cols($column)
{
        mysql_connect("localhost","root","testme");
        @mysql_select_db("MY_READING_LOG") or die( "Unable to select database");
        $query="select DISTINCT ".$column." from EntryTable where entry_complete <> ''";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
        return $num;
}

// Convert house to minutes.
function convertToHoursMins($time, $format = '%d:%d') {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

// total minutes read.
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



// Get reader's name
function get_reader_name($id) {
$reader_name_xml = file_get_contents('http://jerome.lendmyvoice.org/my-reading-log/api/v1/get_reader_info/?id='.$id);
try {
  $sxu = new SimpleXMLElement($reader_name_xml) or die("Error: Cannot create object");
} catch (Exception $e) {
  echo "Bad XML";
  var_dump($sxu);
  exit;
}
$reader_name = $sxu->reader_name;
return $reader_name;
}

function array_sort_by_column(&$array, $column, $direction) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }
	if ($direction=="SORT_ASC") {
    		array_multisort($reference_array, SORT_ASC, $array);
	} else {
    		array_multisort($reference_array, SORT_DESC, $array);
	}
}



$homepage = file_get_contents('http://jerome.lendmyvoice.org/my-reading-log/api/v1/get_entry_list/?id='.$rid);
try { 
  $sxe = new SimpleXMLElement($homepage); 
} catch (Exception $e) { 
  echo "Bad XML";
  var_dump($sxe);
  exit; 
} 


/* For each <character> node, we echo a separate <name>. */
foreach ($sxe->book as $book) {
    $entry[] = array(
                     'date'           	=> (string)$book->date,
                     'title'           	=> (string)$book->title,
                     'author'          	=> (string)$book->author,
                     'genre'           	=> (string)$book->genre,
                     'complete'        => (string)$book->complete,
                     'start' 		=> intval($book->start),
                     'end' 		=> intval($book->end),
                     'minutes' 		=> intval($book->minutes),
                     'pages' 		=> intval($book->pages)
                    );

}

        if ($_GET['aso']=="SORT_ASC") {
                $aso="SORT_DESC";
        } else {
                $aso="SORT_ASC";
        }

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script src="javascript.js"></script>


</head>
<body vlink=white link=white>
<?
if ($_GET['sort']) {
	array_sort_by_column($entry, $_GET['sort'],$aso);
}
echo "<b><font size=+2>".get_reader_name($rid)."'s Reading Log</b>";
echo "<table id=display_table cellspacing=0 cellpadding=3>";
echo "<th><a href=index.php?sort=date&aso=$aso>Date</a></th>";
echo "<th><a href=index.php?sort=title&aso=$aso>Title</a></th>";
echo "<th><a href=index.php?sort=author&aso=$aso>Author</a></th>";
echo "<th><a href=index.php?sort=genre&aso=$aso>Genre</a></th>";
echo "<th><a href=index.php?sort=complete&aso=$aso>Complete</a></th>";
echo "<th>Start</th>";
echo "<th>End</th>";
echo "<th><a href=index.php?sort=minutes&aso=$aso>Minutes</a></th>";
echo "<th><a href=index.php?sort=pages&aso=$aso>Pages</a></th>";


foreach ($entry as $v1) {
   echo "<tr>";
while (list($key, $value) = each($v1)) {
   echo "<td>".$value."</td>";
}
   echo "</tr>";
}
echo "</table><Br>";

if ($_GET['debug'] == "on") {
echo "<Br><Br>Debug<br>";
foreach ($entry as $v1) {

while (list($key, $value) = each($v1)) { 
    echo "$key => $value <Br>"; 
} 
echo "<Br>";
}
}

echo "<font size=2>";
echo "<b>Total Reading Details:</b><br>";
echo "The Student started this reading log on <b>".get_first_date()."</b>.<Br>";
echo "The Student has read a total of <b>".total_pages_read()."</b> page(s).<Br>";
echo "The Student has read for a total of <b>".convertToHoursMins(total_minutes_read(), '%02d hours %02d minutes')."</b>. (That's a total of ".total_minutes_read()." minutes.)<Br>";
echo "This translates into <b>".total_minutes_page(total_minutes_read(),total_pages_read())."</b> minutes per page.<Br>";
echo "The Student has completed reading from a total of <b>".total_cols("entry_title")."</b> book(s).<Br>";
echo "The Student has completed reading from <B>".total_cols("entry_author")."</b> different author(s).<Br>";


?>

<!-- Navigation Bar. Print is disabled. -->
<Br>
<input type=button class='no-print' value="New Entry" onClick="window.location='forms/'">
<input type=button class='no-print' value="Print" onClick="window.print();">
<input type=button class='no-print' value="Forms" onClick="window.location='forms/'">
<input type=button class='no-print' value="Backup DB" onClick="window.location='backup.php'">
<!-- <input type=button class='no-print' value="Remove Row" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?admin=true'"> -->
<input type=button class='no-print' value="Logout" onClick="window.location='logout.php'">

<?





// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><font face=verdana color=blue size=-1><? echo $_COOKIE['message']; ?></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>

</body>
</html>

