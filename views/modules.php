<?php
// query DB
$query = "";
$fields = array(
    'query_type' => 'pdo',
    'query' => 'SELECT * FROM modules ORDER BY name ASC',
);
$this_query = new query($db, $fields);
$data = $this_query->get_result();

// transform data
$headers = array(
    //db name --> pretty name
    'id' => 'Module ID',
    'name' => 'Module Name',
);

$t_data = new transform($data, $headers, $request);
$table = $t_data->get_return_data();