<?php
if (isset($_GET['id']) && $_GET['id'] != '') $req_id = $_GET['id'];
else die("Gal says you need an ID!");

// get title
$title_q_array = array(
    'query_type' => 'pdo',
    'query' => 'SELECT name FROM syllabi WHERE id = ' . $req_id
);
$title_q = new query($db, $title_q_array);
$title_res = $title_q->get_result();
$title = $title_res[0]["name"];

// query DB
$fields = array(
    'query_type' => 'select',
    'table' => 'syllabus_lessons',
    'select_fields' => array('syllabus_id', 'lesson_id', 'module_id', 'lesson_order'),
    'where_conditions' => array('syllabus_id' => $req_id ),
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

$i = 0;
foreach($res_2 as $lesson_title){
    $this_id = $lesson_title['id'];
    //echo $this_id . "<br>";

    $this_syl = $_GET['id'];

    $order_res = array(
        'query_type' => 'pdo',
        'query' => 'SELECT lesson_order FROM syllabus_lessons WHERE syllabus_id = '.$this_syl.' AND lesson_id = ' . $this_id
    );


    $order_q = new query($db, $order_res);
    $order_res = $order_q->get_result();
    $order_res_str = $order_res[0]['lesson_order'];
    $res_2[$i]['lesson_order'] = $order_res_str;
    $i++;
}

//dump_data($res_2);

// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Lesson ID',
    'name' => 'Name ID',
    'lesson_order' => 'Lesson Order',
    'text' => 'Repo',
);
$t_data = new transform($res_2, $headers, $request);
$table = $t_data->get_return_data();
