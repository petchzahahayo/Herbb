<?php

   $host        = "host =127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = db_herb";
   $credentials = "user = postgres password=1234";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } 
   else {
      echo "Opened database successfully\n";
   }
   
?>