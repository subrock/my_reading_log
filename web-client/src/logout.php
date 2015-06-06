<?

unset($_COOKIE["MY_READING_LOG"]);
setcookie("MY_READING_LOG","",time()-1);
header('Location: ./');
?>

