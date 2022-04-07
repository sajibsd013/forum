<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href='/forum/assets/bootstrap/css/bootstrap.min.css'">
  <link rel=" stylesheet" href='/forum/assets/css/style.css'>
  <link rel="stylesheet" href='/forum/assets/font-awesome/css/font-awesome.min.css'>

  <title>Welcome to iDiscuss - Admin</title>
</head>

<body>
  <?php 
  include '_admin_header.php';
  include '../partials/_dbconnect.php';

  if (isset($_GET['comment_id'])) {
    $d_id =  $_GET['comment_id'];
    $d_sql = "DELETE FROM `comments` WHERE `comment_id`=".$d_id;
    $result = mysqli_query($conn, $d_sql);
    $success = "Comment successfully deleted";
    // header("Location: /forum/admin/comments.php?success=".$success);

  }
  
  ?>

  <div class="container" style="min-height:100vh">
    <h1 class="display-4 text-center my-3">Comments administration</h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Comment content</th>
          <th scope="col">Thread</th>
          <th scope="col">Comment by</th>
          <th scope="col">Comment time </th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $sql = "SELECT * FROM `comments`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $comment_id = $row['comment_id'];
          $comment_content  = $row['comment_content'];
          $thread_id  = $row['thread_id'];
          $comment_by = $row['comment_by'];
          $comment_time = $row['comment_time'];

          $sql2 = "SELECT `user_email` FROM `users` WHERE `id` =".$comment_by;
          $result2 = mysqli_query($conn, $sql2);
          $row2= mysqli_fetch_assoc($result2);
          $comment_by = $row2['user_email'];

          $sql3 = "SELECT `thread_title` FROM `threads` WHERE `thread_id` =".$thread_id;
          $result3 = mysqli_query($conn, $sql3);
          $row3= mysqli_fetch_assoc($result3);
          $thread_title  = $row3['thread_title'];

          echo'
          <tr>
            <td  style="max-width:340px">'.$comment_content.'</td>
            <td style="max-width:340px">'.$thread_title.'</td>
            <td >'.$comment_by.'</td>
            <td  style="min-width:130px">'.$comment_time.'</td>
            <td style="min-width:150px" > 
            <a href="/forum/update/update-comments.php?comment_id='.$comment_id .'&type=admin" class="btn btn-success">
            <i class="fa fa-edit "></i>
          </a>
          <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-comments.php?delete_id='.$comment_id.'&type=admin" class="btn btn-danger">
            <i class="fa fa-trash "></i>
          </a>
            </td>
          </tr>
          ';

        }

        ?>

      </tbody>
    </table>


      

  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>