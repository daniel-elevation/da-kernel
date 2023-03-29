<?php
if (isset($_GET['id']) && $_GET['id'] != '') $req_id = $_GET['id'];
else die("Gal says you need an ID!");


// get title
$title_q_array = array(
    'query_type' => 'pdo',
    'query' => 'SELECT name FROM lessons WHERE id = ' . $req_id
);
$title_q = new query($db, $title_q_array);
$title_res = $title_q->get_result();
$title = $title_res[0]["name"];

// query DB
$fields = array(
    'query_type' => 'select',
    'table' => 'lesson_activities',
    'select_fields' => array('lesson_id', 'activity_id', 'activity_order'),
    'where_conditions' => array('lesson_id' => $req_id ),
    'extra_clause' => 'ORDER BY activity_order ASC',
);

// relevant lessons
$this_query = new query($db, $fields);
$data = $this_query->get_result();



if( !isset($data)) die("No Lessons for that module");

$relevant_activities_string = 'WHERE ';
$sep = " OR ";
foreach($data as $row){
    $relevant_activities_string.= "activities.id = '" . $row['activity_id'] . "'" . $sep;
}
$relevant_activities_string = rtrim($relevant_activities_string, $sep);

// query relevant lessons
$fields_2 = array(
    'query_type' => 'pdo',
    'query' => 'SELECT activities.stam_id, activities.id, name, text, url, type, activity_order 
        FROM activities 
            RIGHT JOIN lesson_activities 
                ON activities.id = lesson_activities.activity_id  ' . $relevant_activities_string . ' ORDER BY activity_order',
);

$this_query_2 = new query($db, $fields_2);


$res_2 = $this_query_2->get_result();

//dump_data($res_2);

// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Lesson ID',
    'name' => 'Activity Name',
    'url' => 'Activity URL',
    'type' => 'Activity Type',
    'activity_order' => 'Activity Order',
);
$t_data = new transform($res_2, $headers, $request);
$table = $t_data->get_return_data();
