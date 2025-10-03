<?php
// logout.php
session_start();
session_unset();
session_destroy();

header("Location: http://localhost/CardRBIv2/index.php");
exit;
?>
