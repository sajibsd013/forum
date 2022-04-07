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
if (isset($_GET['id']) && isset($_GET['type'])) {
  $type = $_GET['type'];
  $id = $_GET['id'];

  $sql = "SELECT * FROM `users` WHERE `id`=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $name = $row['user_name'];
  $email = $row['user_email'];
  $birthday = $row['birthday'];
  $user_type = $row['user_type'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['password1'])) {
    $pass1 =  $_POST['password1'];
    $pass2 =  $_POST['password2'];
    if ($pass1 == $pass2) {
      $hashpass = password_hash($pass1, PASSWORD_DEFAULT);

      $sql = "UPDATE `users` SET `user_pass` = '$hashpass' WHERE `users`.`id` =$id";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          $success= "<strong>Success! </strong>Password updated!";
          if ($type=="admin") {
            header("Location: /forum/admin/users.php?success=".$success);
          }
          elseif($type=="user"){
            header("Location: /forum/profile.php?success=".$success);
          }
      }
      else {
          $showError = "Passwords do not match";
          if ($type=="admin") {
            header("Location: /forum/admin/users.php?error=".$showError);
          }
          elseif($type=="user"){
            header("Location: /forum/profile.php?error=".$showError);
          }
      }
    }
  }
  else{
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $birthday =  $_POST['birthday'];
    $user_type =  $_POST['type'];

    $u_sql = "UPDATE `users` SET `user_email`= '$email',`user_name`='$name',`user_type`='$user_type',`birthday`='$birthday'  WHERE `id`=$id";
    $u_result = mysqli_query($conn, $u_sql);

    $success = "User updated successfully";
    if ($type=="admin") {
      header("Location: /forum/admin/users.php?success=".$success);
    }
    elseif($type=="user"){
      session_start();
      $_SESSION["userName"] =  $name;
      $_SESSION["userEmail"] =   $email;
      $_SESSION["birthday"] =   $birthday;
      $_SESSION["userType"] =   $user_type;
      header("Location: /forum/profile.php?success=".$success);
    }
  }

 
}




?>

  <div class="container" style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Update user</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action="" method='post'>
            <div class="form-group">
                <label for="exampleInputEmail1">Name </label>
                <input type="text" minlength="5" class="form-control my-1" id="name" name="name" value="<?php echo $name ?>"  required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" minlength="8" class="form-control my-1" id="email" name="email" value="<?php echo $email ?>" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Date of birth</label>
                <input type="date" class="form-control my-1" id="birthday" name="birthday" value="<?php echo $birthday ?>" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect2">User Type</label>
              <select class="form-select" id="exampleFormControlSelect2" name="type">
                <option selected><?php echo $user_type ?></option>
                <option>user</option>
                <option >admin</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary my-2">Update User</button>
        </form>

        </div>
      </div>

      <h1 class="display-4 text-center my-3">Change Password</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action="" method='post'>
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