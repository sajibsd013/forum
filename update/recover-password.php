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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../partials/_dbconnect.php';

    $email =  $_POST['email'];
    $birthday =  $_POST['birthday'];
    $pass1 =  $_POST['password1'];
    $pass2 =  $_POST['password2'];

    $sql1 = "SELECT * FROM `users` WHERE `user_email`='$email' AND `birthday`='$birthday'";
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result1);
    $id = $row['id'];
    if ($id) {
      if ($pass1 == $pass2) {
        $hashpass = password_hash($pass1, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `user_pass` = '$hashpass' WHERE `users`.`id` =$id";
        $result = mysqli_query($conn, $sql);

        $success = "<strong>Password Changed! </strong>You can now login!";
        header("Location: /forum/index.php?success=$success");
      } else {
        $showError = "Passwords do not match";
        header("Location: /forum/index.php?error=$showError");
      }
    } else {
      $showError = "User not found!";
      header("Location: /forum/index.php?error=$showError");
    }
  }

  ?>

  <div class="container" style="min-height:100vh">
    <h1 class="display-4 text-center mt-5 mb-0">Recover Password</h1>
    <p class="mt-0 mb-4 text-center text-muted">Enter your email and Date of birth to confirm your account</p>
    <div class="row justify-content-center">
      <div class="col-md-8 ">
        <form action="" method='post'>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" minlength="8" class="form-control my-1" id="email" name="email" aria-describedby="emailHelp" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Date of Birth</label>
            <input type="date" class="form-control my-1" id="birthday" name="birthday" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" minlength="8" class="form-control my-1" id="password1" name="password1" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" minlength="8" class="form-control my-1" id="password2" name="password2" required>
          </div>

          <button type="submit" class="btn btn-primary my-2">Update Password</button>
        </form>

      </div>
    </div>

  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>