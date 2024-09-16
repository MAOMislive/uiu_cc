<?php
session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "uiu_cc";

$conn = mysqli_connect($server_name, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}