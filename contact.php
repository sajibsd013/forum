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
  <?php include 'partials/_header.php' ?>

  <div class="container " style="min-height:100vh">
      <h1 class="display-4">Contact us</h1>
      <form method="post" action=" ">
          <div class="form-group">
              <label for="problem_title">Your Name</label>
              <input type="text" class="form-control my-1" id="title" name="title">
          </div>
          <div class="form-group">
              <label for="problem_title">Email</label>
              <input type="email" class="form-control my-1" id="title" name="title">
          </div>
          <div class="form-group my-2">
              <label for="elaborate_problem">Enter Message </label>
              <textarea class="form-control my-1" id="desc" name="desc" rows="3"></textarea>
          </div>

          <button type="submit" class="btn btn-success my-2">Submit</button>
      </form>


  </div>


  <?php include 'partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
  <script src='/forum/assets/js/app.js'></script>

</body>

</html>