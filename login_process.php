<?php
require_once('config_local.php');
require_once('config.php');
//dump_data($_POST);

if(isset($_POST['password']) && $_POST['password'] == "alwayson2022"){
        setcookie ("login","successful",time()+ time()+31556926, "/");
        $forward_location = "LOCATION: " . WEB_PATH;
        header($forward_location);
}
else{
    $forward_location = "LOCATION: " . WEB_PATH . "login.php?act=passno";
    header($forward_location);
}
?>
