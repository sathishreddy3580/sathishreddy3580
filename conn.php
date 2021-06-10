<?php
   $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = postgres";
   $credentials = "user = postgres password=kill777";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
      exit();
   }
   // PDO
   require __DIR__ .'\..\vendor\autoload.php';

   use PostgreSQLTutorial\Connection as Connection;
   use PostgreSQLTutorial\StoreProc as StoreProc;

   try {
       Connection::get()->connect();
       // echo 'A connection to the PostgreSQL database sever has been established successfully.';
   } catch (\PDOException $e) {
       echo $e->getMessage();
   }
?>