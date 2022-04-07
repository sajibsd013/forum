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
include '../partials/_dbconnect.php';

if (isset($_GET['delete_id'])) {

  $d_id =  $_GET['delete_id'];
  
  $d_sql3 = "DELETE FROM `comments` WHERE `comment_id`='$d_id.' OR `reply_to`='$d_id'";
  $result3 = mysqli_query($conn, $d_sql3);

  $success = "Thread successfully deleted";

  if(isset($_GET['type'])){
  $type = $_GET['type'];

    if ($type=="admin") {
      header("Location: /forum/admin/comments.php?success=".$success);
    }
    elseif($type=="user"){
      header("Location: /forum/profile.php?success=".$success);
    }
  }
  elseif(isset($_GET['thread_id'])){
    $thread_id= $_GET['thread_id'];
    header("Location: /forum/thread.php?thread_id=".$thread_id."&success=".$success);

  }


}

if (isset($_GET['comment_id'])) {
  $id = $_GET['comment_id'];
  $sql = "SELECT * FROM `comments` WHERE `comment_id`=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $comment_content  = $row['comment_content'];

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $comment_content =  $_POST['comment_content'];

  $u_sql = "UPDATE `comments` SET `comment_content`= '$comment_content' WHERE `comment_id`=$id";
  $u_result = mysqli_query($conn, $u_sql);

  $success = "Comment updated successfully";
  if(isset($_GET['type'])){
    $type = $_GET['type'];
    if ($type=="admin") {
      header("Location: /forum/admin/comments.php?success=".$success);
    }
    elseif($type=="user"){
      header("Location: /forum/profile.php?success=".$success);
    }
  }
  elseif(isset($_GET['thread_id'])){
    $thread_id= $_GET['thread_id'];
    header("Location: /forum/thread.php?thread_id=".$thread_id."&success=".$success);

  }

}

?>

  <div class="container" style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Update Comment</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action=" " method='post'>
            <div class="form-group my-2">
                <label for="elaborate_problem">Comment </label>
                <textarea class="form-control my-1" id="comment_content " name="comment_content"  rows="5"><?php echo $comment_content ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-2">Update comment</button>
        </form>

        </div>
      </div>

  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>