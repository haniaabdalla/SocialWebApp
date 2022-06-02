<?php
session_start();
include 'userdb.php';
if (isset($_POST['Send'])) {
    $userid = $_SESSION['id'];
    $id = $_GET['id'];
    mysqli_query($conn, "INSERT INTO messages(User1ID,User2ID,message) VALUES ('$userid','$id','" . $_POST['message'] . "')");
    header("Location: messages.php?id=$id");
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 25px auto;
            padding: 0 20px;
            font: 14px sans-serif;
            background-color: #DCDCDC;
        }

        .icons {
            text-align: right;
            font-size: 30px;
        }

        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 25px auto;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .time-right {
            float: right;
            color: #aaa;
        }
        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <h2>Messenger</h2>
    <?php
    include "userdb.php";
    $userid = $_SESSION['id'];
    $id = $_GET['id'];
    $records = mysqli_query($conn, "select * from messages WHERE User1ID='$userid' || User2ID='$userid'  ORDER BY time DESC"); // fetch data from database
    while ($data = mysqli_fetch_array($records)) {
        if ($data['User1ID'] == $id || $data['User2ID'] == $id) {
            $user =  mysqli_query($conn, "select * from users where id='" . $data['User1ID'] . "'");
            $row = mysqli_fetch_array($user)
    ?>
            <div class="container">
            <img src=<?php echo "'posts/" . $row['img'] . "' alt='Avatar'"; ?>>
                <h4><?php echo $row['fullname']; ?></h4>
                <p><?php echo $data['message']; ?></p>
                <span class="time-right"><?php echo $data['time']; ?></span>
            </div>
    <?php
        }
    }
    ?>
    <div class="wrapper">
        <h5>Send message</h5>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="message">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="Send" value="Send">
            </div>
        </form>
    </div>
</body>

</html>