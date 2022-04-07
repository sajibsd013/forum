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

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM `categories` WHERE `category_id`=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $category_name = $row['category_name'];
  $category_description = $row['category_description'];



}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $category_name =  $_POST['category_name'];
  $category_description =  $_POST['category_description'];

  $u_sql = "UPDATE `categories` SET `category_name`= '$category_name', `category_description`='$category_description' WHERE `category_id`=$id";
  $u_result = mysqli_query($conn, $u_sql);

  $success = "Categorie updated successfully";
  header("Location: /forum/admin/categories.php?success=".$success);

}

?>

  <div class="container" style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Update Categorie</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action=" " method='post'>
            <div class="form-group">
                <label for="exampleInputEmail1">Categorie </label>
                <input type="text" minlength="1" class="form-control my-1" id="category_name" name="category_name" value="<?php echo $category_name ?>"  required>
            </div>
            <div class="form-group my-2">
                    <label for="elaborate_problem">Description </label>
                    <textarea class="form-control my-1" id="category_description " name="category_description"  rows="6"><?php echo $category_description ?></textarea>
                </div>
            <button type="submit" class="btn btn-primary my-2">Update Categorie</button>
        </form>

        </div>
      </div>

  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>