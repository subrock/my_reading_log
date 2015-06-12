<?php
// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

// Database connection information.
$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";

if ($_COOKIE['MY_READING_LOG']) {
        $rid=$_COOKIE['MY_READING_LOG'];
}





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


function get_entries() {

$db_host="localhost";
$db_user="root";
$db_password="testme";
$db_name="MY_READING_LOG";
$table_name="EntryTable";
$rid=$_COOKIE['MY_READING_LOG'];
$rid=1;
        mysql_connect($db_host,$db_user,$db_password);
        @mysql_select_db('MY_READING_LOG') or die( "For some reason I am unable to select database");
        $query="select * from EntryTable where entry_reader_id=".$rid;
        $result=mysql_query($query);
$row = mysql_fetch_array($result) or die(mysql_error());

return $result;
}

function get_app_list()
{
  //normally this info would be pulled from a database.
  //build JSON array



  $app_list = array(array("id" => 1, "name" => "Web Demo"), array("id" => 2, "name" => "Audio Countdown"), array("id" => 3, "name" => "The Tab Key"), array("id" => 4, "name" => "Music Sleep Timer")); 

  return $app_list;
}

$possible_url = array("get_entries", "get_app");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
      case "get_entries":
        $value = get_entries();
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

