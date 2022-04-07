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

  <?php 

  include 'partials/_header.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      if(isset($_POST['checkbox'])){
        $check_r = $_POST['checkbox'];
        $sql = "UPDATE `threads` SET `badge` = 'solved' WHERE `thread_id` = '$id'";
        $result = mysqli_query($conn,$sql);
      }
      else{
        $sql = "UPDATE `threads` SET `badge` = 'unsolved' WHERE `thread_id` = '$id'";
        $result = mysqli_query($conn,$sql);
      }
    }
  
    if(isset($_GET['id']) && isset($_GET['checkbox'])){
      $id = $_GET['id'];
      $check_r = $_GET['checkbox'];
      if($check_r == "true"){
        $sql = "UPDATE `threads` SET `badge` = 'solved' WHERE `thread_id` = '$id'";
        $result = mysqli_query($conn,$sql);
      }
      else{
        $sql = "UPDATE `threads` SET `badge` = 'unsolved' WHERE `thread_id` = '$id'";
        $result = mysqli_query($conn,$sql);
      }
    }
  
  ?>
  <div class="container " style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Welcome <?php echo $_SESSION["userName"] ?></h1>

      <div class="row g-5 justify-content-center ">
        <div class="col-md-8 ">
          <a href="/forum/update/update-user.php?id=<?php echo $_SESSION["userId"] ?>&type=user"  class="btn btn-success btn-sm mb-2">
            Edit Profile
            <i class="fa fa-edit "></i>
          </a>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th colspan="2" class="text-center m bg-dark text-light" >
                    User Information
                </th >
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Name</th>
                <td>
                  <?php echo $_SESSION["userName"] ?>
                </td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>
                <?php echo $_SESSION["userEmail"] ?>

                </td>
              </tr>
              <tr>
                <th scope="row">Role</th>
                <td>
                <?php echo $_SESSION["userType"] ?>
                </td>
              </tr>
              <tr>
                <th scope="row">Birthday</th>
                <td>
                <?php echo $_SESSION["birthday"] ?>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-10">

          <table class="table">
              <thead class="thead-dark">
                <tr class="text-center border border-primary rounded bg-primary text-light ">
                  <th colspan="3"  >
                  Threads
                  </th >
                </tr>
              </thead>
              <tbody>

              <?php
                  $id = $_SESSION["userId"];
                  $sql = "SELECT * FROM `threads` WHERE `thread_user_id`=".$id;
                  $result = mysqli_query($conn,$sql);
                  $TnoResult = true;
                  while($row = mysqli_fetch_assoc($result)){
                      $TnoResult = false;
                      $thread_title = $row['thread_title'];
                      $thread_id = $row['thread_id'];
                      $thread_cat_id = $row['thread_cat_id'];
                      $badge = $row['badge'];
                      if($badge == "solved"){
                        $class = "success";
                        $check = "checked";
                      }
                      else{
                        $class = "danger";
                        $check = "none";
                      }

                      echo'
                      <tr class="border">
                        <td>
                          <a href="/forum/thread.php?thread_id='.$thread_id.'" class="text-decoration-none">
                          '.$thread_title.'
                          <span class="badge bg-'.$class.'">'.$badge.'</span>
                          </a> 
                        </td>
                        <td style="width:100px">
                            <a href="/forum/update/update-thread.php?id='.$thread_id.'&type=user" class="btn btn-success btn-sm ">
                              <i class="fa fa-edit "></i>
                            </a>

                            <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-thread.php?delete_id='.$thread_id.'&type=user" class="btn btn-danger btn-sm ">
                              <i class="fa fa-trash "></i>
                            </a>
                        </td>
                        <td style="width:60px">
                          <form id="check_form_'.$thread_id.'" action="" method="post">
                            <div class="form-check form-switch">
                              <input class="form-check-input"  onclick="checkFunc('.$thread_id.', this.value)"  type="checkbox" name="checkbox" id="checkbox_'.$thread_id.'" '.$check.'>
                            </div>
                          </form>

                        </td>
                      </tr>
                      ';
                  }

                  if ($TnoResult) {
                    echo'
                    <tr>
                      <td colspan="3"  >
                        No Thread Found!
                      </td >
                    </tr>
                    ';
                }
        
              ?>

              </tbody>
            </table>
        </div>
        <div class="col-md-10">
          <ul class="list-group">
            <li class="list-group-item active text-center h6">Comments</li>
            <?php
                $id = $_SESSION["userId"];
                $sql = "SELECT * FROM `comments` WHERE `comment_by`=".$id;
                $result = mysqli_query($conn,$sql);
                $noResult = true;
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $comment_content = $row['comment_content'];
                    $comment_id  = $row['comment_id'];
                    $thread_id  = $row['thread_id'];

                    echo'
                        <li class="list-group-item d-flex justify-content-between">
                        <a href="/forum/thread.php?thread_id='.$thread_id .'" class="text-decoration-none">
                          '.$comment_content.'
                        </a>

                          <span class="ms-3" style="min-width:100px">
                            <a href="/forum/update/update-comments.php?comment_id='.$comment_id.'&type=user" class="btn btn-success btn-sm">
                              <i class="fa fa-edit "></i>
                            </a>
                            <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-comments.php?delete_id='.$comment_id.'&type=user" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash "></i>
                            </a>
                          </span>

                        </li>
                    ';
                }

                if ($noResult) {
                  echo'
                        <li class="list-group-item ">No Comment Found!</li>
                  ';
                }
            ?>
            
          </ul>
        </div>
      </div>
  </div>



  <?php include 'partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
  <script src='/forum/assets/js/app.js'></script>

</body>

</html>