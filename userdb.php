<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
/*$sql = "CREATE TABLE Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(30) NOT NULL,
userpassword VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
birth_date DATE
)";

if (mysqli_query($conn, $sql)) {
  echo "Table Users created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
$sql = "CREATE TABLE posts (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  post_body VARCHAR(400) NOT NULL,
  UserID INT(6) NOT NULL,
  post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";*/
//mysqli_close($conn);
?>