<?php
if (isset($_POST['Submit'])) {
    session_start();
    extract($_POST);
    include("userdb.php");

    $sql = mysqli_query($conn, "SELECT * FROM users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        echo '<script>alert("Email already exists.")</script>';
        exit;
    } else {
   
        $filename = $_FILES["filename"]["name"];
        $tempname = $_FILES["filename"]["tmp_name"];
        $folder = "posts/" . $filename;
        echo "<script>alert('filename is = $filename')</script>";
        $query = "INSERT INTO users(fullname,userpassword,email,birth_date,img) VALUES ('$fullname','" . $_POST["password"] . "','$email','$date','$filename')";
      $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
        move_uploaded_file($tempname,$folder);
    // if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $folder)) {
    //     $msg = "Image uploaded successfully";
    //     echo $msg;
    // } else {
    //     $msg = "Failed to upload image";
    //     echo $msg;
    // }
        header("Location: login.php?status=success");
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            background-color: #DCDCDC;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
            margin: 25px auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="POST" enctype="multipart/form-data" >
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Birth Date</label>
                <input type="date" name="date" class="form-control" required>
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="filename" value="image" />
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>