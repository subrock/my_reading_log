<?

// GetLastAuthor - Takes an api call and returns xml with the GetLastAuthor by reader_id. 

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

writeToLog("Starting GetLastAuthor.");

// We only accept POST via back channel. Catch a request header from a POST header.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
writeToLog("POST Request has been made.");

// Get signed key passed. Compare it to the one in key/.
$myfile = fopen("../key/key.pvt", "r") or die("Unable to open file!");
$api_key=fgets($myfile);
fclose($myfile);
writeToLog("Pulling private key.");

$api_sign=$_POST['signiture'];
$reader_id=$_POST['rid'];
if (strcmp($api_sign, $apikey) !== 0) {
	writeToLog("Signiture keys match.");
	// Database connection information.
	$db_host="localhost";
	$db_user="root";
	$db_password="testme";
	$db_name="MY_READING_LOG";

	$reader_id=$_POST['rid'];
	$column=$_POST['column'];
	writeToLog("UID $reader_id");

	$xml = "<?xml version='1.0' standalone='yes'?>";
	$xml = $xml."<entry reader_id='$reader_id'>";
        $query="select * from EntryTable where entry_reader_id=".$reader_id." ORDER BY entry_id DESC LIMIT 1";
	writeToLog($query);
        $result=mysql_query($query);
        $lstAuthor=mysql_result($result,"entry_author");
	writeToLog($lstTitle);
	$xml = $xml . "<author>".$lstAuthor."</author>";
	$xml = $xml . "</entry>";
	writeToLog($xml);
	echo $xml;
	writeToLog("End GetLastAuthor.\n\n");
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

