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


<?php include '_admin_header.php' ?>


  <div class="container" style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Welcome to admin panel</h1>
      <div class="row g-5 justify-content-center my-3">
        <div class="col-md-8">
          <ul class="list-group">
            <li class="list-group-item active text-center h6">iDiscuss App</li>
            <a class="list-group-item" href="/forum/admin/categories.php">Categories</a>
            <a class="list-group-item" href="/forum/admin/threads.php">Threads</a>
            <a class="list-group-item" href="/forum/admin/comments.php">Comments</a>
          </ul>

        </div>
        <div class="col-md-8">
          <ul class="list-group">
            <li class="list-group-item active text-center h6">Authentication administration</li>
            <a class="list-group-item" href="/forum/admin/users.php">Users</a>
          </ul>
        </div>
      </div>
  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>