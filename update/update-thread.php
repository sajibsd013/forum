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

if (isset($_GET['delete_id']) && isset($_GET['type'])) {
  $type = $_GET['type'];


  $d_id =  $_GET['delete_id'];
  $d_sql = "DELETE FROM `threads` WHERE `thread_id`=".$d_id;
  $result = mysqli_query($conn, $d_sql);
  
  $d_sql3 = "DELETE FROM `comments` WHERE `thread_id`=".$d_id;
  $result3 = mysqli_query($conn, $d_sql3);


  $success = "Thread successfully deleted";
  if ($type=="admin") {
    header("Location: /forum/admin/threads.php?success=".$success);
  }
  elseif($type=="user"){
    header("Location: /forum/profile.php?success=".$success);
  }

}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM `threads` WHERE `thread_id`=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $thread_title  = $row['thread_title'];
  $thread_desc  = $row['thread_desc'];
  $thread_cat_id = $row['thread_cat_id'];
  $thread_user_id = $row['thread_user_id'];
  $timestand = $row['timestand'];

  $sql3 = "SELECT `category_name` FROM `categories` WHERE `category_id`=".$thread_cat_id;
  $result3 = mysqli_query($conn, $sql3);
  $row3= mysqli_fetch_assoc($result3);
  $cat = $row3['category_name'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $thread_title =  $_POST['thread_title'];
  $thread_desc =  $_POST['thread_desc'];
  $thread_cat_id =  $_POST['thread_cat_id'];

  $u_sql = "UPDATE `threads` SET `thread_title`= '$thread_title', `thread_desc`='$thread_desc', `thread_cat_id`='$thread_cat_id' WHERE `thread_id`=$id";
  $u_result = mysqli_query($conn, $u_sql);

  $success = "Thread updated successfully";
  if(isset($_GET['type'])){
    $type = $_GET['type'];
    if ($type=="admin") {
      header("Location: /forum/admin/threads.php?success=".$success);

    }
    elseif($type=="user"){
      header("Location: /forum/profile.php?success=".$success);
    }
  }
  else{
    header("Location: /forum/thread.php?thread_id=".$id."&success=".$success);

  }


}

?>

  <div class="container" style="min-height:100vh">
      <h1 class="display-4 text-center my-3">Update Thread</h1>
      <div class="row justify-content-center">
        <div class="col-md-8 ">
          <form action=" " method='post'>
            <div class="form-group">
              <label for="exampleFormControlSelect2">Category</label>
              <select class="form-select" id="exampleFormControlSelect2" name="thread_cat_id">
                <option value="<?php echo $thread_cat_id ?>" selected><?php echo $cat ?></option>
                <?php 
                      $sql = "SELECT * FROM `categories`";
                      $result = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_assoc($result)){
                          $id = $row['category_id'];
                          $cat = $row['category_name'];
                          echo '
                            <option value="'.$id.'">
                              '.$cat.'
                            </option>
                          ';
                      }
                  ?>

              </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title </label>
                <input type="text" minlength="5" class="form-control my-1" id="thread_title" name="thread_title" value="<?php echo $thread_title ?>"  required>
            </div>
            <div class="form-group my-2">
                    <label for="elaborate_problem">Description </label>
                    <textarea class="form-control my-1" id="thread_desc " name="thread_desc"  rows="3"><?php echo $thread_desc ?></textarea>
                </div>
            <button type="submit" class="btn btn-primary my-2">Update Thread</button>
        </form>

        </div>
      </div>

  </div>

  <?php include '../partials/_footer.php' ?>

  <!--  JS Files -->
  <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
</body>

</html>