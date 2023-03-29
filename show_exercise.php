<html>

<head></head>
<body>


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
    $req_type= 'activity';
    $request = $_GET['q'];
    //echo $request;
}
else if( isset($_GET['single']) && $_GET['single'] != '') {
    $req_type= 'exercise';
    $request = $_GET['single'];
    //echo $request;
}
else{
    die("Illegal Request - David will have a word with you. In his office.");
}

// query the lesson and show it
$select_fields = array('id', 'name', 'question', 'instructions', 'exercise_order', 'solution', 'file_type');
if($req_type == 'exercise') $where = array("id" => $request);
else $where = array("activity_id" => $request);

$data = $db->select('exercises', $select_fields, $where, "ORDER BY exercise_order")->results();

//dump_data($data);

if($data){
    foreach($data as $exercise){
        echo '<h1 style="color:blue">Exercise Name: '.$exercise['name'].'</h1>';
        //dump_data($exercise);
        if(isset($exercise['question']) && $exercise['question']!='' && $exercise['question']!='NULL' && $exercise['question']!=NULL){
            echo '<h2 style="color:darkgreen">Question</h2>';
            echo $exercise['question'];
            echo "<br>";
            echo "<br>";
        }
        if(isset($exercise['instructions']) && $exercise['instructions']!='' && $exercise['instructions']!='NULL' && $exercise['instructions']!=NULL ){
            echo '<h2 style="color:darkgreen">Instructions</h2>';
            echo $exercise['instructions'];
            echo "<br>";
            echo "<br>";
        }
        if(isset($exercise['solution']) && $exercise['solution']!='' && $exercise['solution']!='NULL' && $exercise['solution']!=NULL ){
            echo '<h2 style="color:darkred">Solution</h2><code>';
            echo $exercise['solution'];
            echo "</code>";
            echo "<br>";
            echo "<br>";
        }
        if(isset($exercise['file_type']) && $exercise['file_type']!='' && $exercise['file_type']!='NULL' && $exercise['file_type']!=NULL ){
            echo '<h2 style="color:darkorange">File Type</h2><code>';
            echo $exercise['file_type'];
            echo "</code>";
            echo "<br>";
            echo "<br>";
        }
    }
}
//dump_data($data);

else{ echo "Missing Content... Blame It On The Rain!<br><br>"; ?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/BI5IA8assfk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
// get answers
$select_fields = array('id', 'activity_section_id', 'answer', 'is_correct');
$where = array("activity_section_id" => $request);

$answers = $db->select('exercise_answers', $select_fields, $where)->results();

if($answers){

    echo '<h1 style="color:blue">ANSWERS - correct one in <span style="color:blue">blue</span></h1>';
    foreach($answers as $ans){
        if($ans['is_correct'] == "TRUE") $color = "blue";
        else $color = "black";
        echo "<div>";
        echo "<p style='color:".$color."'>" . $ans['answer'] . "</p>";
        echo "</div>";
    }
}
else{
   // die("Daniel hasn't found the answers yet - maybe ask Lotem?!?!");
}
//dump_data($data);


?>

</body>
</html>
