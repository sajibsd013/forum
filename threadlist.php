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
    <?php include 'partials/_dbconnect.php' ?>

    <?php
        $id= $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id=".$id;
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat = $row['category_name'];
            $desc = $row['category_description'];
        }

    ?>

    <?php
        $showAleart = false;

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
            $user_id = $_SESSION["userId"];
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=="POST"){
                //Insert Thread into db
                $th_title = $_POST['title'];
                $th_desc = $_POST['desc'];
                $sql = "INSERT INTO `threads` (`thread_title`, `thread_cat_id`, `thread_user_id`, `thread_desc`) VALUES ('$th_title', '$id', '$user_id', '$th_desc')";
                $result = mysqli_query($conn,$sql);
                $showAleart = true;
            }
        }

        if ($showAleart) {
            echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success! </strong>Your thread has been added. Please wait for community to respond
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>   
            ';
        }
    ?>

    <div class="container ">
        <div class="p-md-5 p-3  my-4 rounded _bg_thread">
            <h1 class="display-4">Welcome to
                <?php echo $cat ;?> Forum
            </h1>
            <p class="lead">
                <?php echo $desc ;?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other. Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio eum ab saepe tempora, illo praesentium repellendus?</p>
        </div>
    </div>

    <div class="container">
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
            $server_uri = $_SERVER['REQUEST_URI'];

            echo '
            <h2 class="my-3">Start a Discussion</h2>
            <form method="post" action=" '.$server_uri.'">
                <div class="form-group">
                    <label for="problem_title">Problem title</label>
                    <input type="text" class="form-control my-1" id="title" name="title">
                    <small id="problem_title" class="form-text text-muted">Keep your title as short and crisp as
                        possible.</small>
                </div>
                <div class="form-group my-2">
                    <label for="elaborate_problem">Elaborate Your Concern </label>
                    <textarea class="form-control my-1" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success my-2">Submit</button>
            </form>
            
            ';

        }
        else{
            echo'
            <div class="p-2 my-3 ">
                <p class="lead">
                You are not logged in. 
                <a class="text-decoration-none text-bold" href="" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</a>
                    or
                <a class="text-decoration-none text-bold" href="" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</a>
                 now to Start a Discussion!
                </p>
            </div>
            ';
            
        }

        ?>

    </div>

    <div id="loadThread">

    </div>

    <?php include 'partials/_footer.php' ?>

    <!--  JS Files -->
    <script src='/forum/assets/bootstrap/js/bootstrap.bundle.js'></script>
    <script src='/forum/assets/js/app.js'></script>
    <script>
        // loadThread
        setInterval(() => {
        console.log(1);
        let currentURL = "partials/_loadThread.php?catid=<?php echo $_GET['catid']; ?>";
        let req = new XMLHttpRequest();
            req.open('GET',`${currentURL}`,true);
            req.send();
            req.onreadystatechange = ()=>{
            if(req.readyState == 4 && req.status == 200){
                document.getElementById('loadThread').innerHTML = req.responseText;
            }
            }
        }, 500);
    </script>

</body>

</html>