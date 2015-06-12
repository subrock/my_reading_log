<html>
 <body>
<h3>
<?php
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_app") 
{
  $app_info = file_get_contents('http://jerome.lendmyvoice.org/my-reading-log/api/v1/api.php?action=get_app&id=' . $_GET["id"]);
//echo $app_info;
  $app_info = json_decode($app_info, true);
  ?>
    <table>
      <tr>
        <td>App Name: </td><td> <?php echo $app_info["app_name"] ?></td>
      </tr>
      <tr>
        <td>Price: </td><td> <?php echo $app_info["app_price"] ?></td>
      </tr>
      <tr>
        <td>Version: </td><td> <?php echo $app_info["app_version"] ?></td>
      </tr>
    </table>
    <br />
    <a href="http://jerome.lendmyvoice.org/my-reading-log/api/v1/REST_Client.php?action=get_app_list" alt="app list">Return to the app list</a>
  <?php
}
else // else take the app list
{
  $app_list = file_get_contents('http://jerome.lendmyvoice.org/my-reading-log/api/v1/api.php?action=get_entries');
//echo $app_list;
  $app_list = json_decode($app_list, true);
  ?>
    <ul>
    <?php foreach ($app_list as $app): 
$i++;
?>
      <li>Entry #<? echo $i; ?>
        <a href=<?php echo "http://jerome.lendmyvoice.org/my-reading-log/api/v1/REST_Client.php?action=get_app&id=" . $app["id"]  ?> alt=<?php echo "app_" . $app_["id"] ?>><?php echo $app["entry_title"]." - ".$app["3"] ?></a>
    </li>
    <?php endforeach; ?>
    </ul>
  <?php
} ?>
 </body>
</html>


