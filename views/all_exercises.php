<?php
// query DB
$query = "";
$fields = array(
    'query_type' => 'pdo',
    'query' => 'SELECT distinct id, name FROM exercises ORDER BY name ASC ',
);
$this_query = new query($db, $fields);
$data = $this_query->get_result();

// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Exercise ID',
    'name' => 'Exercise Name',
);

$t_data = new transform($data, $headers, $request);
$table = $t_data->get_return_data();