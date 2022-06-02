<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  
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
  width: 360px;
  padding: 20px;
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
</style>
</head>

<body>
<?php include('header.php'); ?>
    <h2>Notifications</h2>
    <?php
        include "userdb.php";
        session_start();
        $records = mysqli_query($conn, "select * from posts ORDER BY post_date DESC"); // fetch data from database
        while ($data = mysqli_fetch_array($records)) {
          if($data['UserID'] != $_SESSION["id"]){
            $userid = $data['UserID'];
            $user =  mysqli_query($conn, "select * from users where id='" . $data['UserID'] . "'");
            $row  = mysqli_fetch_array($user);
    ?>
    <div class="container">
        <p><?php echo $row['fullname']." added a new post."; ?></p>
        <span class="time-right"><?php echo $data['post_date']; ?></span>
    </div>
    <?php
        }
      }
    ?>
</body>

</html>