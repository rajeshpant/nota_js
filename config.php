<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**

 * Create database connection

 */

$conn = new mysqli('localhost', 'root', '', 'nota');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}