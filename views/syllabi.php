<?php
// query DB
$query = "";
$fields = array(
    'query_type' => 'pdo',
    'query' => 'SELECT id, name FROM syllabi ORDER BY name ASC',
);
$this_query = new query($db, $fields);
$data = $this_query->get_result();

//dump_data($data);


// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Syllabus ID',
    'name' => 'Syllabus Name',
);

$t_data = new transform($data, $headers, $request);
$table = $t_data->get_return_data();