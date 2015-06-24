<?

// GetEntryList - Takes an api call and returns xml of a log entry list based on reader_id. 

// Include functions.php later.
function totalPages($start,$end)
{
        $rtn = ($end - $start) + 1;
        return $rtn;
 }




// Initiate logging.
function writeToLog($message) {
        $logDate = new DateTime();
        $logDate = $logDate->format("y:m:d h:i:s");
        exec('touch api.log');
        $myfile = fopen("api.log", "a") or die("Unable to open file!");
        $message = "\n".$logDate." ".$message;
        fwrite($myfile, $message);
        //fclose($myfile);
}

writeToLog("Starting GetEntryList.");

// We only accept POST via back channel. Catch a request header from a POST header.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
writeToLog("POST Request has been made.");

// Get signed key passed. Compare it to the one in key/.
$myfile = fopen("../key/key.pvt", "r") or die("Unable to open file!");
$api_key=trim(fgets($myfile));
$api_sign=$_POST['signiture'];
fclose($myfile);
writeToLog("Pulling private key.");

if (strcmp($api_sign, $api_key) == 0) {
	writeToLog("Signiture keys match.");
	// Database connection information.
	$db_host="localhost";
	$db_user="root";
	$db_password="testme";
	$db_name="MY_READING_LOG";

	$reader_id=$_POST['rid'];
	writeToLog("UID $reader_id");

	$xml = "<?xml version='1.0' standalone='yes'?>";
	$xml = $xml."<entry reader_id='$reader_id'>";
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db('MY_READING_LOG') or die( "For some reason I am unable to select database");
        $query="select * from EntryTable where entry_reader_id=".$reader_id;
        $result=mysql_query($query);
	$num=mysql_numrows($result);
	writeToLog("$num records returned.");
	
	$i=0;
	while ($i < $num) {
		$xml = $xml . "<book>";
		$xml = $xml . "<date>".mysql_result($result,$i,"entry_date")."</date>";
		$xml = $xml . "<title>".mysql_result($result,$i,"entry_title")."</title>";
		$xml = $xml . "<author>".mysql_result($result,$i,"entry_author")."</author>";
		$xml = $xml . "<genre>".mysql_result($result,$i,"entry_genre")."</genre>";
		$xml = $xml . "<complete>".mysql_result($result,$i,"entry_complete")."</complete>";
		$xml = $xml . "<start>".mysql_result($result,$i,"entry_start")."</start>";
		$xml = $xml . "<end>".mysql_result($result,$i,"entry_end")."</end>";
		$xml = $xml . "<minutes>".mysql_result($result,$i,"entry_minutes")."</minutes>";
		$xml = $xml . "<pages>".totalPages(mysql_result($result,$i,'entry_start'),mysql_result($result,$i,'entry_end'))."</pages>";
		$xml = $xml . "</book>";
		$i++;
	}
	$xml = $xml . "</entry>";
	echo $xml;
	writeToLog("End GetEntryList.\n\n");
	exit;
} else {
	// Key compare failed. Redirect to an error page. 
	setcookie("message","Missing API private key.", time() + 300, '/');
	header('Location: ../error.php');
} // End key compare.
} // End post request

setcookie("message","An error has occured. No post was detected.", time() + 300, '/');
header('Location: ../error.php');

?>

