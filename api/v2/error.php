<html>
<head>
<title>Something is not correct.</title>
<style>
.shadow_a {
-moz-box-shadow: 0 0 5px #888;
-webkit-box-shadow: 0 0 5px#888;
box-shadow: 0 0 5px #888;
background: #FFFF99;
float:relative;
padding:15px;
margin:15px;
}

</style>
</head>
<body bgcolor=white>
<font face=verdana size=3>
<font size=2>
<a href=backup.php>Backup Database</a> | <A href=convdb.php>Convert Database</a>
<hr>
<Br><Br><Br>
<?

// Process messages and then clear them.
if ($_COOKIE['message']) {
?>
<center><div style='width: 300px' class="shadow_a" id=testdiv align=left><font face=verdana color=black size=-1>
If you are seeing this message chances are an error has occured. The error message returned is;
<Br><Br><b><center><? echo $_COOKIE['message']; ?></b></center></div></center>
<? }
?>



</body>
</html>


