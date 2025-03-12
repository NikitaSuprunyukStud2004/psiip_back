<?php
setcookie('visits', '', time() - 3600);
header("Location: cookie.php");
exit();
?>
