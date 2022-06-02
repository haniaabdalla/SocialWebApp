
<?php
session_start();
include 'userdb.php';
$userid = $_SESSION['id'];
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM postlikes where UserID='$userid' and PostID='$id'");
if (mysqli_num_rows($sql) == 0) {
    $sql = "UPDATE posts SET likes=likes+1 WHERE id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql) or die("Could Not Perform the Query");
    $sql = "INSERT INTO postlikes (PostID,UserID) VALUES ('$id','$userid')";
    $result = mysqli_query($conn, $sql);
}
header("Location: home.php");
?>