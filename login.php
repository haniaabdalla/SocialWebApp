<?php
session_start();
if(isset($_POST['submit']))
{
    extract($_POST);
    include 'userdb.php';
    $sql=mysqli_query($conn,"SELECT * FROM users where email='$email' and userpassword='$userpassword'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["id"] = $row['id'];
        $_SESSION["fullname"]=$row['fullname'];
        $_SESSION["email"]=$row['email'];
        header("Location: home.php"); 
    }
    else
    {
        echo '<script>alert("Invalid Email or Password")</script>';
    }
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
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="userpassword" class="form-control">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>