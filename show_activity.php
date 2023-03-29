<?php

require_once('config_local.php');
require_once('config.php');

// is user logged in?
if(isset($_COOKIE['login']) && $_COOKIE['login'] == 'successful'){ }
else {
    $forward_location = "LOCATION: " . WEB_PATH . "login.html";
    header($forward_location);
}

// is this s legal request? set parameters
if( isset($_GET['q']) && $_GET['q'] != '') {
    $request = $_GET['q'];
    //echo $request;
}
else{
    die("Illegal Request - Karin will speak to you soon (in German1)");
}

// query the lesson and show it
$select_fields = array('id', 'text', 'url');
$where = array("id" => $request);

$data = $db->select('activities', $select_fields, $where)->results();

//dump_data($data);
if(isset($data[0]['text']) && $data[0]['text']!=''){
    echo $data[0]['text'];
}
else if(isset($data[0]['url']) && $data[0]['url']!=''){
    echo $data[0]['url'];
}
else{ echo "Missing Content... Blame It On The Rain!<br><br>"; ?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/BI5IA8assfk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

