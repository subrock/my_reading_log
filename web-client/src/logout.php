<?

unset($_COOKIE["MY_READING_LOG"]);
setcookie("MY_READING_LOG","",time()-1);
setcookie("message","Reader has been logged out.", time() + 30, '/');
header('Location: ./');
?>

