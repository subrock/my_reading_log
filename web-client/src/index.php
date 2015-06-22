<?php

// Authentication 
if (!$_COOKIE['MY_READING_LOG']) {
        header('Location: ./login.php');
        exit;
} else {
	$rid=$_COOKIE['MY_READING_LOG'];
}

include './functions.php';
include './submit.php';


$aso=$_GET['aso'];

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
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
<script src=jquery.min.js></script>
<script src="javascript.js"></script>
<script>
function show(target){
document.getElementById(target).style.display = 'block';
document.getElementById("clickMeId").style.display = 'none';
}
function hide(target){
document.getElementById(target).style.display = 'none';
document.getElementById("clickMeId").style.display = 'block';
}
</script>

<script type="text/javascript">
function load() {
window.scrollTo(0, document.body.scrollHeight);
}
</script>


</head>

<body vlink=white link=white onload="load()">
<?
if ($_GET['sort']) {
	array_sort_by_column($entry, $_GET['sort'],$aso);
}
echo "<b><font size=+2>".get_reader_name($rid)."'s Reading Log</b>";
echo "<table id=display_table cellspacing=0 cellpadding=3 >";
echo "<th width=10><a href=index.php?sort=date&aso=$aso>Date</a></th>";
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
}
echo "</table><br>";

if ($_GET['debug'] == "on") {
echo "<Br><Br>Debug<br>";
foreach ($entry as $v1) {

while (list($key, $value) = each($v1)) { 
    echo "$key => $value <Br>"; 
} 
}
}

echo "<font size=2>";
echo "<b>Total Reading Details:</b><br>";
echo "The Student with UID of $rid started this reading log on <b>".get_first_date()."</b>.<Br>";
echo "The Student has read a total of <b>".total_pages_read()."</b> page(s).<Br>";
echo "The Student has read for a total of <b>".convertToHoursMins(total_minutes_read(), '%02d hours %02d minutes')."</b>. (That's a total of ".total_minutes_read()." minutes.)<Br>";
echo "This translates into <b>".total_minutes_page(total_minutes_read(),total_pages_read())."</b> minutes per page.<Br>";
echo "The Student has completed reading from a total of <b>".total_cols("entry_title")."</b> book(s).<Br>";
echo "The Student has completed reading from <B>".total_cols("entry_author")."</b> different author(s).<Br>";


?>

<!-- Navigation Bar. Print is disabled. -->
<Br>
<input type=button class='no-print' value="New Entry" onclick="show('entrydiv')">
<input type=button class='no-print' value="Print" onClick="window.print();">
<input type=button class='no-print' value="Forms" onClick="window.location='forms/'">
<!-- <input type=button class='no-print' value="Remove Row" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?admin=true'"> -->
<input type=button class='no-print' value="Logout" onClick="window.location='logout.php'">

<?

// Entry Dialog (Modal Popup) 
echo "<form name=new_entry action=".$_SERVER['PHP_SELF']." method=POST>";
echo "<div class=shadow_b style='display:none' id=entrydiv align=left><font face=verdana color=blue size=-1>";
echo "Date:<Br><input name=Date type=text size=30 value='".date("Y-m-d", time() - 60 * 60 * 24)."'><br>";
echo "Title:<Br><input name=Title type=text size=30 value='".lastTitle($rid)."'><br>";
echo "Author:<Br><input name=Author type=text size=30 value='".lastAuthor($rid)."'><br>";
echo "Genre:<Br><select name=Genre style='width: 243px' autocomplete=off><option>F</option><option>NF</option></select><br>";
echo "Completed:<Br><select name=Complete style='width: 243px' autocomplete=off><option value=''>No</option><option>Yes</option></select><br>";
echo "Start:<Br><input name=Start type=text size=30 autocomplete=off><br>";
echo "End:<Br><input name=End type=text size=30 autocomplete=off><br>";
echo "Minutes:<Br><input name=Minutes type=text size=30 autocomplete=off><br>";
echo "<Br><input type=submit value=Save> ";
echo "<input type=button value=Cancel onclick=hide('entrydiv')>";
echo "</div>";
echo "</form>";



// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><font face=verdana color=blue size=-1><? echo $_COOKIE['message']; ?></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>

<?
// Div menu for modify, delete, pin date, filter author.
echo "<div class=shadow_c style='display:none' id=rclickdiv align=left>";
echo "<a href=modify.php?id=>Modify Record</a>";
echo "</div>";
?>

</body>
</html>

