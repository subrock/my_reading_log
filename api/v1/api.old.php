<? include 'functions.php'; ?>
<?

// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

//echo $_COOKIE['MY_READING_LOG'];
if (!$_COOKIE['MY_READING_LOG']) {
        //header('Location: ./login.php');
        $rid=$_COOKIE['MY_READING_LOG'];
        //echo "<a href=login.php>Login</a>";
        exit;
}

?>
<?php
// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

function get_app_by_id($id)
{
  $app_info = array();

  // normally this info would be pulled from a database.
  // build JSON array.
  switch ($id){
    case 1:
      $app_info = array("app_name" => "Web Demo", "app_price" => "Free", "app_version" => "2.0"); 
      break;
    case 2:
      $app_info = array("app_name" => "Audio Countdown", "app_price" => "Free", "app_version" => "1.1");
      break;
    case 3:
      $app_info = array("app_name" => "The Tab Key", "app_price" => "Free", "app_version" => "1.2");
      break;
    case 4:
      $app_info = array("app_name" => "Music Sleep Timer", "app_price" => "Free", "app_version" => "1.9");
      break;
  }

  return $app_info;
}

// Funtion to return a player name and number.
function get_player_info($id)
{
  $player_info = array();

// $id is the playerID in the players table. switch the the right $id and array will be popluated with that players info.
// Info returned
// Player Name
// Player Number
// Games Played
// Career Average
// Career Hits
  
   switch ($id){
    case 1:
      $player_info = array("app_name" => "Web Demo", "app_price" => "Free", "app_version" => "2.0");
      break;
    case 2:
      $app_info = array("app_name" => "Audio Countdown", "app_price" => "Free", "app_version" => "1.1");
      break;
    case 3:
      $app_info = array("app_name" => "The Tab Key", "app_price" => "Free", "app_version" => "1.2");
      break;
    case 4:
      $app_info = array("app_name" => "Music Sleep Timer", "app_price" => "Free", "app_version" => "1.9");
      break;
  }

  return $app_info;
}




function get_entry_list()
{
  //normally this info would be pulled from a database.
  //build JSON arrayi

        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db($db_name) or die( "Unable to select database");
        $query="select * from EntryTable where reader_id=".$rid;
        //echo $query;
        $result=mysql_query($query);

$bapp="";
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {

$id=mysql_result($result,$r,"entry_id");

$i++;
}

  $app_list = array(array("id" => 1, "name" => "Web Demo"), array("id" => 2, "name" => "Audio Countdown"), array("id" => 3, "name" => "The Tab Key"), array("id" => 4, "name" => "Music Sleep Timer")); 
echo $app_list;
  return $app_list;
}

$possible_url = array("get_entry_list", "get_app");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
      case "get_entry_list":
        $value = get_entry_list();
        break;
      case "get_app":
        if (isset($_GET["id"]))
          $value = get_app_by_id($_GET["id"]);
        else
          $value = "Missing argument";
        break;
    }
}

//return JSON array
exit(json_encode($value));
?>
