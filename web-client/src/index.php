<?php



// Authentication 
if (!$_COOKIE['MY_READING_LOG']) {
        header('Location: ./login.php');
        exit;
} else {
	$rid=$_COOKIE['MY_READING_LOG'];
}


$aso=$_GET['aso'];


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
echo "</table>";

if ($_GET['debug'] == "on") {
echo "<Br><Br>Debug<br>";
foreach ($entry as $v1) {

while (list($key, $value) = each($v1)) { 
    echo "$key => $value <Br>"; 
} 
echo "<Br>";
}
}

echo "<Br>";
?>

<!-- Navigation Bar. Print is disabled. -->
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

