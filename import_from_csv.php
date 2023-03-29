<?php
die("disabled by TenBis");
ini_set('memory_limit', '-1');
require_once('config_local.php');
require_once('config.php');

$file = 'activities.csv';


$lines = explode( "\n", file_get_contents( $file) );
$headers = str_getcsv( array_shift( $lines ) );
$data = array();
foreach ( $lines as $line ) {

    $row = array();

    foreach ( str_getcsv( $line ) as $key => $field )
        $row[ $headers[ $key ] ] = $field;

    $row = array_filter( $row );

    $data[] = $row;

}

//print_r($employee_csv);


//$dds = array("id", "name", "type", "activity_id", "optional", "question", "question_body", "test_suite_name", "instructions", "submission_type", "file_type", "order", "priority", "solution");


//$rows = $db->select($orig_table, $fields)->results();
$target_table = 'activities';
foreach($data as $row){
    $new_row = array();
    foreach($row as $k => $v){
        $v = addslashes($v);
        $new_row[$k] = strip_tags($v, '<a>');
    }
    //dump_data($new_row);
    $ins = $db->insert($target_table, $new_row);
   //die();

}