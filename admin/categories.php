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
    $d_sql = "DELETE FROM `categories` WHERE `category_id`=".$d_id;
    $result = mysqli_query($conn, $d_sql);
    $success = "Categorie successfully deleted";
    header("Location: /forum/admin/categories.php?success=".$success);

  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name =  $_POST['category_name'];
    $category_description =  $_POST['category_description'];
  
    $sql = "INSERT INTO `categories`(`category_name`, `category_description`) VALUES ('$category_name','$category_description')";
    $result = mysqli_query($conn, $sql);
  
    $success = "Categorie added successfully";
    header("Location: /forum/admin/categories.php?success=".$success);
  
  }
  
  ?>



  <div class="container" style="min-height:100vh">
  
    <h1 class="display-4 text-center my-3">Categories administration</h1>
    <a class="btn btn-outline-primary justify-content-end" href="#add_cat">Add Categories 
    <i class="fa fa-plus-square "></i>
    </a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Category</th>
          <th scope="col">Description</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['category_id'];
          $category_name = $row['category_name'];
          $category_description = $row['category_description'];
          $created = $row['created'];
          echo'
          <tr>
            <td>'.$category_name.'</td>
            <td style="max-width:340px">'.$category_description.'</td>
            <td style="min-width:130px">'.$created.'</td>
            <td style="min-width:150px"> 
              <a  href="/forum/update/update-categories.php?id='.$id.'" class="btn btn-success">
              <i class="fa fa-edit "></i>
              </a>
              <a onclick="return confirm(`Are you sure?`)" href="/forum/admin/categories.php?delet_user_id='.$id.'" class="btn btn-danger">
              <i class="fa fa-trash "></i>
              </a>
            </td>
          </tr>
          ';

        }

        ?>

      </tbody>
    </table>

    <h1 id="add_cat" class="display-4 text-center mb-2 mt-5">Add Categorie</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action=" " method='post'>
            <div class="form-group">
                <label for="exampleInputEmail1">Categorie </label>
                <input type="text" minlength="1" class="form-control my-1" id="category_name" name="category_name"  required>
            </div>
            <div class="form-group my-2">
                    <label for="elaborate_problem">Description </label>
                    <textarea class="form-control my-1" id="category_description " name="category_description"  rows="4"></textarea>
                </div>
            <button type="submit"  class="btn btn-primary my-2">Add Categorie</button>
        </form>
        </div>
      </div>
      

  </div>


  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
  <script>
    function myFunction() {
      confirm('Yes?')
    }
    </script>
</body>

</html>