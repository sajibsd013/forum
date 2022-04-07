<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href='/forum/assets/bootstrap/css/bootstrap.min.css'">
    <link rel=" stylesheet" href='/forum/assets/css/style.css'>
    <link rel="stylesheet" href='/forum/assets/font-awesome/css/font-awesome.min.css'>

  <title>Welcome to iDiscuss - Doding Forum</title>
</head>

<body>

  <?php include 'partials/_header.php'?>
  <?php include 'partials/_dbconnect.php' ?>


  <div class="container" style="min-height:100vh">
      <h1 class="display-4 my-5 text-center">Results for
        <em> "<?php echo  $_GET['search'] ?>" </em> 
      </h1>
      <?php
        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) against ('".$_GET['search']."')";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
          $noResult = false;
          $thread_title = $row['thread_title'];
          $thread_desc = $row['thread_desc'];
          $timestand = $row['timestand'];
          $id = $row['thread_id'];
          $thread_user_id = $row['thread_user_id'];
          $badge = $row['badge'];
            if($badge == "solved"){
              $class = "success";
              $check = "checked";
            }
            else{
              $class = "danger";
              $check = "none";
            }

          
          $sql2 = "SELECT `user_email` FROM `users` WHERE `id` =".$thread_user_id;
          $result2 = mysqli_query($conn, $sql2);
          $row2= mysqli_fetch_assoc($result2);
          $user_email = $row2['user_email'];
          
          echo'
          <div class="justify-content-between my-3">
              <h6 class="my-0"> <a class="text-decoration-none" href="/forum/thread.php?thread_id='.$id.'">  '.$thread_title.'</a>
              <span class="badge bg-'.$class.'">'.$badge.'</span>
              </h6> 
              <small class=" text-muted my-1">asked by '.$user_email.' '.$timestand.' </small>
          </div> ';

        }

        if ($noResult) {
          echo'
          <div class="p-5 my-3 rounded _bg_thread">
              <h1 class="display-4">No Threads Found!</h1>
              <p class="lead">Be the first person to ask question </p>
          </div>
          ';
      }
         
      ?>
  </div>

  <?php include 'partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
  <script src='/forum/assets/js/app.js'></script>

</body>

</html>