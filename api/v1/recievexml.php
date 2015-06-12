<?php
$aso=$_GET['aso'];
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



$homepage = file_get_contents('http://jerome.lendmyvoice.org/my-reading-log/api/v1/get_entry_list/');
//echo $homepage;


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

if ($_GET['sort']) {
	array_sort_by_column($entry, $_GET['sort'],$aso);
}

echo "<table border=1 cellpadding=5 cellspacing=15>";
echo "<th><a href=recievexml.php?sort=date&aso=$aso>Date</a></th>";
echo "<th><a href=recievexml.php?sort=title&aso=$aso>Title</a></th>";
echo "<th><a href=recievexml.php?sort=author&aso=$aso>Author</a></th>";
echo "<th><a href=recievexml.php?sort=genre&aso=$aso>Genre</a></th>";
echo "<th><a href=recievexml.php?sort=complete&aso=$aso>Complete</a></th>";
echo "<th>Start</th>";
echo "<th>End</th>";
echo "<th><a href=recievexml.php?sort=minutes&aso=$aso>Minutes</a></th>";
echo "<th><a href=recievexml.php?sort=pages&aso=$aso>Pages</a></th>";


foreach ($entry as $v1) {
   echo "<tr>";
while (list($key, $value) = each($v1)) {
   echo "<td>".$value."</td>";
}
   echo "</tr>";
}
echo "</table>";

echo "<Br><Br>Debug<br>";
foreach ($entry as $v1) {

while (list($key, $value) = each($v1)) { 
    echo "$key => $value <Br>"; 
} 
echo "<Br>";
}
echo "<Br><Br>";

?>
