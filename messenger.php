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

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
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

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
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
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <h2>Messenger</h2>
    <?php
    include "userdb.php";
    session_start();
    $records = mysqli_query($conn, "select * from users"); // fetch data from database
    while ($data = mysqli_fetch_array($records)) {
        if ($data['id'] != $_SESSION["id"]) {
    ?>
            <div class="container">
                <img src=<?php echo "'posts/" . $data['img'] . "' alt='Avatar'"; ?>>
                <h4><?php echo $data['fullname']; ?></h4>
                <?php
                echo "<a href=\"messages.php?id=" . $data['id'] . "\" >Send a Message</a><br>"; ?>

            </div>
    <?php
        }
    }
    ?>
</body>

</html>