<?php

require '../connect/connectdb.php';

$p = $_GET['term'];

if (empty($p))
{
    exit;
}


$sql = "SELECT * FROM herb_name WHERE name_th LIKE '%$p%' ";

$query = pg_query($sql);

if (pg_num_rows($query) > 0) 
{
    $a = array();   
    while ($data = pg_fetch_array($query)) 
    {
        array_push($a, $data['name_th']);
    }
    echo json_encode($a);
}