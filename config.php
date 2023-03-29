<?php

define('LOCAL_PATH', $localPath);
define('WEB_PATH', $webPath);


// req DB class
require_once (LOCAL_PATH . "classes/class-pdowrapper.php");
$db = new PdoWrapper($db_config_array);


function dump_data($data, $title = ''){
    echo "<pre>";
    if($title != '') echo "<h1>" . $title . "</h1>";
    var_dump($data);
    echo "</pre>";
}