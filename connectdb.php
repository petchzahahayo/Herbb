<?php

$host = "host =18.223.23.119";
$port = "port = 5432";
$dbname = "dbname = db_herb";
$credentials = "user=Dong password=123456";

$db = pg_connect("$host $port $dbname $credentials");

if (!$db)
{
    echo "Error : Unable to open database\n";
} 
else 
{
    echo "Opened database successfully\n";
}