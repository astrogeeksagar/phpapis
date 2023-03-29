<?php
$conn = mysqli_connect('localhost', 'root', '', 'sagar');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>