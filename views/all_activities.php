<?php
// query DB
$query = "";
$fields = array(
    'query_type' => 'pdo',
    'query' => 'SELECT distinct id, name, type FROM activities ORDER BY name ASC ',
);
$this_query = new query($db, $fields);
$data = $this_query->get_result();

// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Activity ID',
    'name' => 'Activity Name',
    'type' => 'Activity Type',
);

$t_data = new transform($data, $headers, $request);
$table = $t_data->get_return_data();