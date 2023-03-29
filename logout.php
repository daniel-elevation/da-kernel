<?php
require_once("config_local.php");
require_once("config.php");
setcookie ("login","successful",time() -3600, "/");

dump_data($_COOKIE);
?>
