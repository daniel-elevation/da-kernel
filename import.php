<?php
die("disabled by TenBis");
require_once('config_local.php');
require_once('config.php');

$orig_table = 'activities_orig';
$target_table = 'activities';

// activities
$fields = array("id", "name", "optional", "text", "url", "test_folder_name", "type", "created_at", "updated_at");

// modules
//$fields = array("id", "name", "topic_id", "created_at", "updated_at", "field_id");


//lesson_modules
//$fields = array("lesson_id", "module_id", "lesson_order");

//lessons
//$fields = array("lesson_id","name", "repo_name", "ghc_url", "color", "duration_in_minutes", "created_at", "updated_at", "learning_objectives", "overview", "lab_id", "lab_instance_id", "test_framework", "author_id", "lab_settings", "type", "is_tested");

//lesson activities
//$fields = array("lesson_id", "activity_id", "activity_order");

// syllabi
//$fields = array("id", "name");

// syllabus lessons
//$fields = array("syllabus_id", "lesson_id", "module_id", "lesson_order");

// exercise answers
//$fields = array(
//    "id",
//"activity_section_id",
//"is_correct",
//"answer"
//);

$rows = $db->select($orig_table, $fields)->results();

foreach($rows as $row){
    $new_row = array();
    foreach($fields as $field){
        $new_row[$field] = $row[$field];
    }
    //dump_data($new_row);

    // check if exists
    $query = "SELECT id FROM ".$target_table." WHERE id=" . $row['id'];
    $check = $db->pdoQuery($query)->results();
    if($check) { }
    else $ins = $db->insert($target_table, $new_row);
}