<?
// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

// Global db connect
mysql_connect($db_host,$db_user,$db_password);
@mysql_select_db($db_name) or die( "Unable to select database");


// Global Functions

function totalPagesAll($record)
{
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function toalPagesPin($record)
{
        $query="select * from entry_table where entry_id=".$record;
        $result=mysql_query($query);
        $start=mysql_result($result,0,"Start");
        $end=mysql_result($result,0,"End");
        $rtn = ($end - $start) + 1;
        return $rtn;
 }

function setAuthenticationCookie($reader_id) {
	setcookie("MY_READING_LOG","$reader_id");
}

function lookupreadername($id) {
        $query="select reader_name from ReaderTable where reader_id=".$id;
        $result=mysql_query($query);
        $reader_name=mysql_result($result,0,"reader_name");
	return $reader_name;
}

function lastTitle($id) {
        $query="select * from EntryTable where entry_reader_id=".$id." ORDER BY entry_id DESC LIMIT 1";
        $result=mysql_query($query);
        $lstTitle=mysql_result($result,0,"entry_title");
	return $lstTitle;

}

function lastAuthor($id) {
        $query="select * from EntryTable where entry_reader_id=".$id." ORDER BY entry_id DESC LIMIT 1";
        $result=mysql_query($query);
        $lstAuthor=mysql_result($result,0,"entry_author");
        return $lstAuthor;

}

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



?>
