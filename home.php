<?php
include("userdb.php");
session_start();
if (isset($_POST['post'])) {
    
    $id = $_SESSION["id"];
    //echo $id;
    $filename = $_FILES["filename"]["name"];
    $tempname = $_FILES["filename"]["tmp_name"];
    $folder = "posts/" . $filename;
    $post_body = $_POST['post_body'];
    $query = "INSERT INTO posts (post_body,UserID,img) VALUES ('$post_body','$id','$filename')";
    $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
    move_uploaded_file($tempname,$folder);
    header("Location: home.php?status=success");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font: 14px sans-serif;
            background-color: #DCDCDC;
        }

        .wrapper {
            width: 400px;
            padding: 20px;
            margin: 25px auto;
        }

        .icons {
            text-align: right;
            font-size: 30px;
        }
        .card{
            margin: 25px auto;
        }
        .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
    </style>
</head>

<body>
<?php include('header.php'); ?>
    <div class="wrapper">
        <h2>Home Feed</h2>
        <form action="home.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>What's in your mind?</label>
                <input type="text" name="post_body" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" name="filename">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="post" value="Post">
            </div>
        </form>
    </div>
    <?php
    include "userdb.php"; // Using database connection file here
    $records = mysqli_query($conn, "select * from posts ORDER BY post_date DESC"); // fetch data from database
    while ($data = mysqli_fetch_array($records)) {
        $userid = $data['UserID'];
        $user =  mysqli_query($conn, "select * from users where id='" . $data['UserID'] . "'");
        $row  = mysqli_fetch_array($user);
    ?>
        <div class="card" style="width: 50rem;">
            <h5 class="card-header"><?php echo $row['fullname']; ?></h5>
            <div class="card-body">
                <p class="card-text"><?php echo $data['post_body']; ?></p>
                <?php echo "<img src='posts/".$data['img']."' class='center' style='width:40%' 'length:40%'>"; ?>
                <p class="card-text"><small class="text-muted"><?php echo $data['likes'] . " Likes"; ?></small></p>
                <?php $post_id = $data['id'];
                echo "<a href=\"likes.php?id=" . $post_id . "\" >Like</a><br>" ;
                echo "<a href=\"comments.php?id=" . $post_id . "\" >Comment</a><br>"; 
                ?>
                
            </div>
        </div><br>
    <?php
    }
    ?>
    <div class="wrapper">
        <form action="home.php" method="post">
            <div class="text-center">Want to edit name or password? <br><a href="edit.php">Edit</a></div>
            <div class="text-center">Want to logout? <br><a href="logout.php">Logout</a></div>
        </form>
    </div>
</body>

</html>