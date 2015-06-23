<?
setcookie("message","Invalid URI.", time() + 300, '/');
 header('Location: ./error.php');
?>

