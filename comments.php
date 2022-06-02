<?php
session_start();
include 'userdb.php';
if (isset($_POST['Comment'])) {
    $userid = $_SESSION['id'];
    $id = $_GET['id'];
    mysqli_query($conn, "INSERT INTO comments(PostID,UserID,comment) VALUES ('$id','$userid','" . $_POST['comment'] . "')");
    header("Location: comments.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post</title>
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
        }

        .icons {
            text-align: right;
            font-size: 30px;
        }

        .card {
            margin: 25px auto;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 25px auto;
        }
        .container img {
            float: left;
            max-width: 50px;
            width: 60%;
            margin-right: 20px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php include('header.php');
    include "userdb.php"; // Using database connection file here
    $id = $_GET['id'];
    $records = mysqli_query($conn, "select * from posts WHERE id='$id'"); // fetch data from database
    $data = mysqli_fetch_array($records);
    $userid = $data['UserID'];
    $user =  mysqli_query($conn, "select * from users where id='$userid'");
    $row  = mysqli_fetch_array($user);
    ?>
    <div class="card" style="width: 50rem;">
        <h5 class="card-header"><?php echo $row['fullname']; ?></h5>
        <div class="card-body">
            <p class="card-text"><?php echo $data['post_body']; ?></p>
            <?php echo "<img src='posts/" . $data['img'] . "' class='center' style='width:40%' 'length:40%'>"; ?>
            <p class="card-text"><small class="text-muted"><?php echo $data['likes'] . " Likes"; ?></small></p>
            <?php $post_id = $data['id'];
            echo "<a href=\"likes.php?id=" . $post_id . "\" >Like</a><br>";
            echo "<a href=\"comments.php?id=" . $post_id . "\" >Comment</a><br>";
            ?>
            <?php
            include "userdb.php";
            $id = $_GET['id'];
            $hania = mysqli_query($conn, "select * from comments WHERE PostID = $id"); // fetch data from database
            while ($comment = mysqli_fetch_array($hania)) {
                $userid = $comment['UserID'];
                $users =  mysqli_query($conn, "select * from users where id='" . $comment['UserID'] . "'");
                $username  = mysqli_fetch_array($users);
            ?>

                <div class="container">
                <img src=<?php echo "'posts/" . $username['img'] . "' alt='Avatar'"; ?>>
                    <h5><?php echo $username['fullname']; ?></h5>
                    <p><?php echo $comment['comment']; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="wrapper">
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="comment">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="Comment" value="Comment">
                </div>
            </form>
        </div>
    </div><br>

</body>

</html>