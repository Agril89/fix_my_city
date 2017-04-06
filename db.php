<?php
# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app.
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}
# Here we establish the connection. Yes, that's all.
pg_connect("dbname=d1srmsgt82bu8m user=isydexkvgtiacw password=25eea9d65194cf69e844e939961d82864002e53e40c3b036e3b377ab4654c494") or die("Couldn't Connect ".pg_last_error()); // Connect to the Database

$sql = "CREATE TABLE users (
  username varchar(32) NOT NULL PRIMARY KEY,
  email varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
    first_name varchar(16) NOT NULL,
    last_name varchar(16) NOT NULL,
    gender varchar(1) NOT NULL,
)";
# Now let's use the connection for something silly just to prove it works:
$query = pg_query($sql); // Execute the Query
if($query)
  echo "Table Created"; // Check to see if The Query Worked.
else{
  echo "An error Occured! ".pg_last_error();
}
print "\n";
?>