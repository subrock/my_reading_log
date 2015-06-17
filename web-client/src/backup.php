<html>
<head>
<title></title>
</head>
<body>


<?

if(isset($_GET['add'])) {
 
$myfile='backups/backup-'.date('m-d-Y_hia').'.sql';

exec('./dump.sh '.$myfile);
}



$dircontents = scandir('backups/');

	echo '<br> ';
	foreach ($dircontents as $file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		if ($extension == 'sql') {
			echo "$file<Br>";
		}
	}




?>
<Br>
<input type=button value="Backup Database" onClick="window.location='backup.php?add=true'">
<input type=button value="Return" onClick="window.location='./'">



</body>
</html>

