<pre>
<?php

 $dbhost = "186.226.56.200";
 $dbuser = "absegcor_master";
 $dbpass = "Ld230551";
 $db = "absegcor_site";

$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$db);

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}else{
	echo "Conectou!<br/>";
}

// Perform query
if ($result = $mysqli->query("SHOW TABLES")) {
  echo "Returned rows are: " . $result->num_rows;
  // Free result set
  $result->free_result();
}

$mysqli->close();

?>
</pre>
