<?

// GetReaderName - Takes an api call and returns xml with the GetReaderName by reader_id. 

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

writeToLog("Starting GetReaderName.");

// We only accept POST via back channel. Catch a request header from a POST header.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
writeToLog("POST Request has been made.");

// Get signed key passed. Compare it to the one in key/.
$myfile = fopen("../key/key.pvt", "r") or die("Unable to open file!");
$api_key=trim(fgets($myfile));
$api_sign=$_POST['signiture'];
$reader_id=$_POST['rid'];
fclose($myfile);
writeToLog("Pulling private key.");

if (strcmp($api_sign, $api_key) == 0) {
	writeToLog("Signiture keys match.");
	// Database connection information.
	$db_host="localhost";
	$db_user="root";
	$db_password="testme";
	$db_name="MY_READING_LOG";

	writeToLog("UID $reader_id");

	$xml = "<?xml version='1.0' standalone='yes'?>";
	$xml = $xml."<entry reader_id='$reader_id'>";

        mysql_connect("localhost","root","testme");
        @mysql_select_db("MY_READING_LOG") or die( "Unable to select database");
        $query="select * from ReaderTable where reader_id=$reader_id";
        $result=mysql_query($query);
	$reader_name= mysql_result($result,0,"reader_name");
	$xml = $xml . "<reader_name>".$reader_name."</reader_name>";
	$xml = $xml . "</entry>";
	writeToLog($xml);
	echo $xml;
	writeToLog("End GetReaderName.\n\n");
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

