<?php

$db= new mysqli("localhost","root","","flexez");

if ($db -> connect_error) {
    echo "Failed to connect to MySQL: " . $db -> connect_error;
    exit();
  }

?>