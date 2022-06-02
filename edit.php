<?php
session_start();
if (isset($_POST['submit'])) {
    extract($_POST);
    include 'userdb.php';
    $id = $_SESSION["id"];/* userid of the user */
    mysqli_query($conn, "UPDATE users set fullname='" . $_POST["newfullname"] . "' WHERE id=$id");
    echo '<script>alert("Fullname Changed")</script>';
}
elseif (isset($_POST['save'])) {
    extract($_POST);
    include 'userdb.php';
    $id = $_SESSION["id"];/* userid of the user */
    $result = mysqli_query($conn, "SELECT userpassword FROM users WHERE id=$id");
    $row = mysqli_fetch_array($result);
    if($_POST["currentpassword"] == $row["userpassword"]) {
        mysqli_query($conn,"UPDATE users set userpassword='" . $_POST["newpassword"] . "' WHERE id='" . $id . "'");
        echo '<script>alert("Password Changed")</script>';
    } else {
        echo '<script>alert("Password is incorrect,")</script>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Profile Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif; background-color: #DCDCDC;
        }

        .wrapper {
            width: 360px;
            padding: 20px; margin:25px auto;
        }
    </style>
</head>

<body>
<?php include('header.php'); ?>
    <div class="wrapper">
    <h2>Edit Profile</h2><br>
        <form action="" method="post">
            <h5>Edit Your Fullname</h5>
            <div class="form-group">
                <label>New Fullname</label>
                <input type="text" name="newfullname" class="form-control">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Update">
            </div>
        </form>
    </div>
    <div class="wrapper">
        <form action="" method="post">
        <h5>Change Your Password</h5>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="currentpassword" class="form-control" value="">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="newpassword" class="form-control" required>
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="save" value="Update">
            </div>
        </form>
    </div>
</body>

</html>