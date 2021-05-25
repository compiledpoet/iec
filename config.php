<?php
$servername = "localhost";
$user_id = "username";
$password = "password";


$conn = mysqli_connect($servername, $user_id, $password);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>