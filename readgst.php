<?php

// konek ke db

require_once __DIR__ . "/connection.php";
mysqli_select_db($conn, "db5e2");

// query jlnkan
$sql = "SELECT id, firstname, lastname FROM myguests";
// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Process the result set
if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. 
    " - First Name: " . $row["firstname"]. 
    " - Last Name: " . $row["lastname"].
    "<br>";
  }
} else {
  echo "0 results - data not found";
}

mysqli_close($conn);
?>
