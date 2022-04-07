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
  
  ?>

  <div class="container" style="min-height:100vh ; overflow-x:scroll">
    <h1 class="display-4 text-center my-3">Threads administration</h1>

    <table class="table table-striped" >

      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Category</th>
          <th scope="col">Created By</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $sql = "SELECT * FROM `threads`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $thread_id = $row['thread_id'];
          $thread_title  = $row['thread_title'];
          $thread_desc  = $row['thread_desc'];
          $thread_cat_id = $row['thread_cat_id'];
          $thread_user_id = $row['thread_user_id'];
          $timestand = $row['timestand'];

          $sql2 = "SELECT `user_email` FROM `users` WHERE `id` =".$thread_user_id;
          $result2 = mysqli_query($conn, $sql2);
          $row2= mysqli_fetch_assoc($result2);
          $created_by = $row2['user_email'];

          $sql3 = "SELECT `category_name` FROM `categories` WHERE `category_id` =".$thread_cat_id;
          $result3 = mysqli_query($conn, $sql3);
          $row3= mysqli_fetch_assoc($result3);
          $cat = $row3['category_name'];


          echo'
          <tr>
            <td style="max-width:340px">'.$thread_title.'</td>
            <td style="max-width:340px">'.substr($thread_desc,0,100).'...</td>
            <td>'.$cat.'</td>
            <td >'.$created_by.'</td>
            <td  style="min-width:130px">'.$timestand.'</td>
            <td  style="min-width:130px"> 
              <a href="/forum/update/update-thread.php?id='.$thread_id.'&type=admin" class="btn btn-success">
              <i class="fa fa-edit "></i>
              </a>
              <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-thread.php?delete_id='.$thread_id.'&type=admin" class="btn btn-danger">
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