<?php
session_start();
include 'userdb.php';
if(isset($_POST['submit']))
{
    extract($_POST);
    $id= $_SESSION["id"];
    if($bio){
    $sql=mysqli_query($conn,"UPDATE users set bio='$bio' where id='$id'");
    mysqli_query($conn,$sql);
    }
    if($skills){
        $sql=mysqli_query($conn,"INSERT INTO skills(UserID,skill) VALUES ('$id','$skills')");
        mysqli_query($conn,$sql);
    }
    if($skills1){
        $sql=mysqli_query($conn,"INSERT INTO skills(UserID,skill) VALUES ('$id','$skills1')");
        mysqli_query($conn,$sql);
    }
    if($skills2){
        $sql=mysqli_query($conn,"INSERT INTO skills(UserID,skill) VALUES ('$id','$skills2')");
        mysqli_query($conn,$sql);
    }
}
if(isset($_POST['submit'])){
    header("Location: profile.php");
}
if(isset($_POST['skip'])){
    header("Location: profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; background-color: #DCDCDC; }
        .wrapper{ width: 360px; padding: 20px; margin: 25px auto;}
    </style>
</head>
<body>
<?php include('header.php'); ?>
    <div class="wrapper">
        <h2>More Info</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>Bio</label>
                <input type="text" name="bio" class="form-control">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Skills</label>
                <input type="text" name="skills" class="form-control" value="">
                <input type="text" name="skills1" class="form-control" value="">
                <input type="text" name="skills2" class="form-control" value="">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit">
                <input type="submit" class="btn btn-primary" name="skip" value="Skip">
            </div>
        </form>
    </div>
</body>
</html>