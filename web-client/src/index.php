<?php

// Authentication 
if (!$_COOKIE['MY_READING_LOG']) {
        header('Location: ./login.php');
        exit;
} else {
	$rid=$_COOKIE['MY_READING_LOG'];
}

include './settings.php';
include './functions.php';
include './submit.php';

$aso=$_GET['aso'];

$postdata = http_build_query(
    array(
        'signiture' => $api_key,
        'rid' => $rid
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
$homepage = file_get_contents($api_url."/GetEntryList/",false,$context);

try { 
  $sxe = new SimpleXMLElement($homepage); 
} catch (Exception $e) { 
echo "An Error Occured. Usually no XML response. Which means Key failed or error on API side.<Br><Br><pre>$e</pre>";
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
<script src=jquery.min.js></script>
<script src="javascript.js"></script>


</head>
<body style="margin:10;padding:10" alink=silver vlink=navy link=navy onload="load()" bgcolor=#303030>
<a name=top></a>


<?
if ($_GET['sort']) {
	array_sort_by_column($entry, $_GET['sort'],$aso);
}
echo "<table id=display_table cellspacing=0 cellpadding=3 ><th>";
echo $my_name." (".get_reader_name($api_key,$rid).")</th></table>";
?>

<!-- Navigation Bar. Print is disabled. -->
<Br>
<input class=btn type=button class='no-print' value="New Entry" onclick="show('entrydiv')">
<?
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') != true) {
?>
<input class=btn type=button class='no-print' value="Print" onClick="window.print();">
<?
}
?>
<!-- <input class=btn type=button class='no-print' value="Forms" onClick="window.location='forms/'"> -->
<!-- <input type=button class='no-print' value="Remove Row" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?admin=true'"> -->
<input class=btn type=button class='no-print' value="Bottom" onClick="window.location='#bottom'">
<input class=btn type=button class='no-print' value="Logout" onClick="window.location='logout.php'">
<Br><Br>
<?
echo "<table id=display_table cellspacing=0 cellpadding=3 bgcolor=white>";
echo "<th width=10><a href=./?sort=date&aso=$aso>Date</a></th>";
echo "<th><a href=./?sort=title&aso=$aso>Title</a></th>";
echo "<th><a href=./?sort=author&aso=$aso>Author</a></th>";
echo "<th><a href=./?sort=genre&aso=$aso>Genre</a></th>";
echo "<th><a href=./?sort=complete&aso=$aso>Complete</a></th>";
echo "<th>Start</th>";
echo "<th>End</th>";
echo "<th><a href=./?sort=minutes&aso=$aso>Minutes</a></th>";
echo "<th><a href=./?sort=pages&aso=$aso>Pages</a></th>";

foreach ($entry as $v1) {
   echo "<tr class=str>";
while (list($key, $value) = each($v1)) {
   echo "<td nowrap>".$value."</td>";
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

$first_date=get_first_date($api_key,$rid);
if ($first_date != "") {
echo "<table id=display_table cellspacing=0 cellpadding=3 bgcolor=white>";
echo "<th>Reading Metrics:</th><tr><td>";
echo "The Student with UID of $rid started this reading log on <b>".get_first_date($api_key,$rid)."</b>.<Br>";
echo "The Student has read a total of <b>".total_pages_read($api_key,$rid)."</b> page(s).<Br>";
echo "The Student has read for a total of <b>".convertToHoursMins(total_minutes_read($api_key,$rid), '%02d hours %02d minutes')."</b>. (That's a total of ".total_minutes_read($api_key,$rid)." minutes. Great work!)<Br>";
echo "This translates into <b>".total_minutes_page(total_minutes_read($api_key,$rid),total_pages_read($api_key,$rid))."</b> minutes per page.<Br>";
echo "The Student has completed reading from a total of <b>".total_cols("entry_title",$api_key,$rid)."</b> book(s).<Br>";
echo "The Student has completed reading from <B>".total_cols("entry_author",$api_key,$rid)."</b> different author(s).<Br>";
echo "</td></tr></table>";
}
?>

<!-- Navigation Bar. Print is disabled. -->
<Br>
<input class=btn type=button class='no-print' value="New Entry" onclick="show('entrydiv')">
<?
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') != true) { 
?>
<input class=btn type=button class='no-print' value="Print" onClick="window.print();">
<?
}
?>
<!-- <input class=btn type=button class='no-print' value="Forms" onClick="window.location='forms/'"> -->
<!-- <input type=button class='no-print' value="Remove Row" onClick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?admin=true'"> -->
<input class=btn type=button class='no-print' value="Top" onClick="window.location='#top'">
<input class=btn type=button class='no-print' value="Logout" onClick="window.location='logout.php'">

<?

// Entry Dialog (Modal Popup) 
echo "<form name=new_entry action=".$_SERVER['PHP_SELF']." method=POST>";
echo "<div class=shadow_b style='display:none' id=entrydiv align=left><font face=verdana color=black size=3>";
echo "Date:<Br><input style='font-weight: bold;' name=Date type=text size=30 value='".date("Y-m-d", time() - 60 * 60 * 24)."'><br>";
echo "Title:<Br><input style='font-weight: bold;' name=Title type=text size=30 value='".lastTitle($api_key,$rid)."'><br>";
echo "Author:<Br><input style='font-weight: bold;' name=Author type=text size=30 value='".lastAuthor($api_key,$rid)."'><br>";
echo "Genre:<Br><input style='font-weight: bold;' name=Genre type=text size=30 value='F'><br>";
echo "Completed:<Br><input style='font-weight: bold;' name=Complete type=text size=30><br>";
echo "Start:<Br><input style='font-weight: bold;' name=Start type=text size=30 autocomplete=off><br>";
echo "End:<Br><input style='font-weight: bold;' name=End type=text size=30 autocomplete=off><br>";
echo "Minutes:<Br><input style='font-weight: bold;' name=Minutes type=text size=30 autocomplete=off><br>";
echo "<Br><input class=btn type=submit value=Save> ";
echo "<input class=btn type=button value=Cancel onclick=hide('entrydiv')>";
echo "</div>";
echo "</form>";


// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<div class="shadow_a" id=testdiv align=center><b><font face=verdana color=red size=2><? echo $_COOKIE['message']; ?></div>
<? }
setcookie("message","Lets see what happens.",time()-3600);
?>
<a name=bottom></a>
</body>
</html>

