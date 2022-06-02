<html>

<head>
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

        .card {
            margin: 25px auto;
            background-color: #DCDCDC;
        }

        .img {
            border-radius: 50%;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .avatar {
            width: 50px;
            height: 150px;
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <?php
    session_start();
    include "userdb.php"; // Using database connection file here
    $id = $_SESSION["id"];
    $user =  mysqli_query($conn, "select * from users where id='$id'");
    $row  = mysqli_fetch_array($user);
    ?>
    <div class="card" style="width: 40rem;"><br>
        <?php echo "<img src='posts/" . $row['img'] . "' class='avatar' style='width:20%' 'length:20%' alt='Avatar'>"; ?>
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['fullname']; ?></h5>
            <p class="card-text"><?php echo $row['bio']; ?></p>
            <p class="card-text"><?php echo "Birthday at " . $row['birth_date'] . "."; ?></p>
            <p class="card-text"><?php echo "Email contact is " . $row['email'] . "."; ?></p>
            <?php
            $skills = mysqli_query($conn, "select * from skills WHERE UserID='" . $_SESSION["id"] . "'"); // fetch data from database
            while ($skill = mysqli_fetch_array($skills)) {
            ?>

                <p class="card-text"><?php echo $skill['skill'] . "."; ?></p>
            <?php } ?>
            <a href="edit.php" class="btn btn-primary">Edit Name or Password</a>
            <a href="info.php" class="btn btn-primary">Add Info</a>
        </div>
    </div>
    <?php
    include "userdb.php"; // Using database connection file here
    $records = mysqli_query($conn, "select * from posts WHERE UserID='" . $_SESSION["id"] . "' ORDER BY post_date DESC "); // fetch data from database
    while ($data = mysqli_fetch_array($records)) {
    ?>
        <div class="card" style="width: 50rem;">
            <h5 class="card-header"><?php echo $row['fullname']; ?></h5>
            <div class="card-body">
                <p class="card-text"><?php echo $data['post_body']; ?></p>
                <?php echo "<img src='posts/" . $data['img'] . "' class='center' style='width:40%' 'length:40%'>"; ?>
                <p class="card-text"><small class="text-muted"><?php echo $data['likes'] . " Likes"; ?></small></p>
                <?php $post_id = $data['id'];
                echo "<a href=\"likes.php?id=" . $post_id . "\" >Like</a><br>";
                echo "<a href=\"comments.php?id=" . $post_id . "\" >Comment</a>"; ?>
            </div>
        </div><br>
    <?php } ?>
    <div class="wrapper">
        <form action="" method="post">
            <div class="text-center">Want to logout? <br><a href="logout.php">Logout</a></div>
        </form>
    </div>
</body>

</html>