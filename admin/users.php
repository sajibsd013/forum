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

  if (isset($_GET['delet_user_id'])) {
    $d_id =  $_GET['delet_user_id'];

    $d_sql = "DELETE FROM `users` WHERE `id`=".$d_id;
    $result = mysqli_query($conn, $d_sql);

    $d_sql0 = "SELECT `thread_id` FROM `threads` WHERE `thread_user_id`=".$d_id;
    $result0 = mysqli_query($conn, $d_sql0);
    while($row0 = mysqli_fetch_assoc($result0)){
      $thread_id = $row0['thread_id'];
      $d_sql3 = "DELETE FROM `comments` WHERE `thread_id`=".$thread_id;
      $result3 = mysqli_query($conn, $d_sql3);
    }

    $d_sql1 = "DELETE FROM `threads` WHERE `thread_user_id`=".$d_id;
    $result1 = mysqli_query($conn, $d_sql1);

    $d_sql2 = "DELETE FROM `comments` WHERE `comment_by`=".$d_id;
    $result2 = mysqli_query($conn, $d_sql2);


    $success = "user successfully deleted";
    header("Location: /forum/admin/users.php?success=".$success);

  }
  
  ?>



  <div class="container" style="min-height:100vh">
    <h1 class="display-4 text-center my-3">Users administration</h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">User Type</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['id'];
          $name = $row['user_name'];
          $email = $row['user_email'];
          $user_type = $row['user_type'];
          $time = $row['timestamp'];
          echo'
          <tr>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td>'.$user_type.'</td>
            <td>'.$time.'</td>
            <td> 
              <a href="/forum/update/update-user.php?id='.$id.'&type=admin" class="btn btn-success">
                <i class="fa fa-edit "></i>
              </a>
              <a onclick="return confirm(`Are you sure?`)" href="/forum/admin/users.php?delet_user_id='.$id.'" class="btn btn-danger">
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