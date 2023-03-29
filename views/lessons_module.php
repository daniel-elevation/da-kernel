<?php

if (isset($_GET['id']) && $_GET['id'] != '') $req_id = $_GET['id'];
else die("Gal says you need an ID!");

// get title
$title_q_array = array(
    'query_type' => 'pdo',
    'query' => 'SELECT name FROM modules WHERE id = ' . $req_id
);
$title_q = new query($db, $title_q_array);
$title_res = $title_q->get_result();
$title = $title_res[0]["name"];


// query DB
$fields = array(
    'query_type' => 'select',
    'table' => 'lesson_modules',
    'select_fields' => array('lesson_id', 'module_id', 'lesson_order'),
    'where_conditions' => array('module_id' => $req_id ),
    'extra_clause' => 'ORDER BY lesson_order ASC',
);

// relevant lessons
$this_query = new query($db, $fields);
$data = $this_query->get_result();

if( !isset($data)) die("No Lessons for that module");

$relevant_lessons_string = 'WHERE ';
$sep = " OR ";
foreach($data as $row){
    $relevant_lessons_string.= "id = " . $row['lesson_id'] . $sep;
}
$relevant_lessons_string = rtrim($relevant_lessons_string, $sep);

// query relevant lessons
$fields_2 = array(
    'query_type' => 'pdo',
    'query' => 'SELECT id, name, repo_name FROM lessons ' . $relevant_lessons_string,
);
$this_query_2 = new query($db, $fields_2);
$res_2 = $this_query_2->get_result();

//dump_data($res_2);

// transform data
$headers = array(
    'id' => 'Activity ID',
    'name' => 'Lesson Name',
    'repo' => 'Lesson Repo',
);
$t_data = new transform($res_2, $headers, $request);
$table = $t_data->get_return_data();

