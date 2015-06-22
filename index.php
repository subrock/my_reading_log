<?
setcookie("message","Invalid URI.", time() + 30, '/');
 header('Location: api/v2/error.php');
?>

