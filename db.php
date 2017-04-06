<?php
# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app.
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

# Here we establish the connection. Yes, that's all.
$pg_conn = pg_connect(pg_connection_string_from_database_url());

if(!$pg_conn){
die ('Non riesco a connettermi: errore '.mysql_error()); // questo apparirà solo se ci sarà un errore
}

/*
$sql = "CREATE TABLE IF NOT EXIST users (
  username varchar(32) NOT NULL PRIMARY KEY,
  email varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
    first_name varchar(16) NOT NULL,
    last_name varchar(16) NOT NULL,
    gender varchar(1) NOT NULL
)";

$query = pg_query($sql); 
if($query)
  echo "Table Created"; 
else{
  echo "An error Occured! ".pg_last_error();
}
*/

?>