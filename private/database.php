<?php
require_once('db_credentials.php');
function db_connect(){
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}

function db_disconnect(){
  isset($conn) && $conn->close();
}

function db_escape($conn, $string){
  return mysqli_real_escape_string($conn, $string);
}

?>