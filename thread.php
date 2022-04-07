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

        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM `threads` WHERE `thread_id` = ".$id;
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            $badge = $row['badge'];
            if($badge == "solved"){
              $class = "success";
              $check = "checked";
            }
            else{
              $class = "danger";
              $check = "none";
            }
            
            $sql2 = "SELECT `user_email` FROM `users` WHERE `id` =".$thread_user_id;
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user_email = $row2['user_email'];
        }

        ?>

    <?php
        $showAleart = false;
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
            $user_id = $_SESSION["userId"];
            if($_SERVER['REQUEST_METHOD']=="POST"){

                if(isset($_POST['comment'])){
                    //Insert comment into db
                    $th_comment = $_POST['comment'];
                    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES('$th_comment','$id','$user_id')";
                    $result = mysqli_query($conn,$sql);
                    $showAleart = true;
                }

                if(isset($_POST['reply'])){
                    //Insert reply into db
                    $th_reply = $_POST['reply'];
                    $comment_id = $_POST['comment_id'];
                    $sql = "INSERT INTO `comments` (`comment_content`, `reply_to`, `comment_by` ,`thread_id`) VALUES('$th_reply','$comment_id','$user_id','$id')";
                    $result = mysqli_query($conn,$sql);
                    $showAleart = true;
                }

            }

            if ($showAleart) {
                echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success! </strong>Comment Added
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>   
                ';

            }
        }
    ?>


    <div class="container " style="min-height:100vh">
        <div class="p-md-5 p-3 my-4 rounded _bg_thread">
            <h2 class="display-4">
                <?php echo $title ;?>
                <sup style="font-size:16px" class="badge bg-<?php echo $class ;?>"><?php echo $badge ;?> </sup>
            </h2>
        
            <p class="lead"> <?php echo $desc ;?> </p>
            <hr class="my-4">
            <small class="d-block my-3">This is a peer to peer forum for sharing knowledge with each other. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat, architecto. Asperiores praesentium pariatur voluptas commodi dignissimos adipisci quibusdam facilis hic!</small>
            <p>Posted by: <strong><?php echo $user_email ?> </strong></p>

            <?php 
                if(isset($_SESSION["userId"]) && $thread_user_id == $_SESSION["userId"]){
                    echo'
                    <div style="">
                        <a href="/forum/update/update-thread.php?id='.$id.'" class="btn btn-success btn-sm">Edit
                        <i class="fa fa-edit "></i>
                        </a>
                        <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-thread.php?delete_id='.$id.'&type=user" class="btn btn-danger btn-sm">Delete

                        <i class="fa fa-trash "></i>
                        </a>
                    </div>
                    ';
                }
            ?> 
        </div>

        <?php

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
            $server_uri = $_SERVER['REQUEST_URI'];
            echo '
            <h2 class="my-3">Post a Comment</h2>
            <form method="post" action=" '.$server_uri.'">
                <div class="form-group my-2">
                    <textarea class="form-control my-1" id="" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success my-2">Post a Comment</button>
            </form>
            ';
        }
        else{
            echo'
            <div class="p-2 my-3">
                <p class="lead">
                You are not logged in. 
                <a class="text-decoration-none text-bold" href="" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</a>
                    or
                <a class="text-decoration-none text-bold" href="" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</a>
                 now to Post a Comment!
                </p>
            </div>
            ';
            
        }
        ?>

    <?php
        if(isset($_GET['comment_id']) && isset($_GET['user_id'])){
            $user_id =  $_GET['user_id'];
            $comment_id =  $_GET['comment_id'];

            $sql_isLiked = "SELECT * FROM `votes` WHERE `comment_id`='$comment_id' AND `user_id`= '$user_id'";
            $result_isLiked = mysqli_query($conn, $sql_isLiked);
            $isLiked = mysqli_num_rows($result_isLiked);

            if($isLiked == 0){
                $sql = "INSERT INTO `votes` (`comment_id`, `user_id`) VALUES ('$comment_id','$user_id')";
                $result = mysqli_query($conn,$sql);
    
            }else{
                $sql = " DELETE FROM `votes` WHERE `comment_id`='$comment_id' AND `user_id`= '$user_id'";
                $result = mysqli_query($conn,$sql);
            }
        }
    ?>

        
        <?php

        $sql = "SELECT * FROM `comments` WHERE `reply_to`='0' AND `thread_id` =".$id;
        $result = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($result);
        echo '
        <h3 class="my-4"> 
            <i class="fa fa-comments text-primary "></i>
            '.$rows.' Discussions
        </h3>
        ';
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $server_uri = $_SERVER['REQUEST_URI'];

            $noResult = false;
            $comment_id = $row['comment_id'];
            $comment = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_by_id = $row['comment_by'];
            
            $sql2 = "SELECT `user_email` FROM `users` WHERE `id` =".$comment_by_id;
            $result2 = mysqli_query($conn, $sql2);

            $row2= mysqli_fetch_assoc($result2);
            $comment_by = $row2['user_email'];


            if(isset($_SESSION["userId"]) && $comment_by_id == $_SESSION["userId"]){
                $edit_code_comment = '
                <span style="">
                <a href="/forum/update/update-comments.php?comment_id='.$comment_id .'&thread_id='.$id.'" class="text-decoration-none mx-1">
                    Edit
                </a>
                <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-comments.php?delete_id='.$comment_id.'&thread_id='.$id.'" class="text-decoration-none mx-1">
                    Delete
                </a>
                </span>
                ';
            }
            else{
                $edit_code_comment = "<span></span>";
            }

            if(isset($_SESSION["userId"])){
                $user_id = $_SESSION["userId"];
                $vote_url_comment = '/forum/thread.php?thread_id='.$id.'&comment_id='.$comment_id.'&user_id='.$_SESSION["userId"];

                $sql_isLiked = "SELECT * FROM `votes` WHERE `comment_id`='$comment_id' AND `user_id`= '$user_id'";
                $result_isLiked = mysqli_query($conn, $sql_isLiked);
                $isLiked = mysqli_num_rows($result_isLiked);
                if($isLiked == 0){
                    $class_like = "secondary";
                }else{
                    $class_like = "danger";
                }
            }
            else{
                $vote_url_comment = "#";
                $class_like = "secondary";
            }



            $sql_count_vote = "SELECT * FROM `votes` WHERE `comment_id`='$comment_id' ";
            $result_count_vote = mysqli_query($conn, $sql_count_vote);
            $total_vote = mysqli_num_rows($result_count_vote);


            echo'
            <div class=" d-flex my-2 border p-3">
                <div class="w-100">
                    <small class="my-1 text-muted "><i class="fa fa-user-circle text-primary me-1"></i>'.$comment_by.' at '.$comment_time.'  </small>
                    <h6 class="my-0 ">'.$comment.' </h6>
                    <small class="my-1 text-muted ">
                        <a href="'.$vote_url_comment.'" class="text-decoration-none btn px-0">
                            <i style="font-size:24px" class="mx fa fa-heart text-'.$class_like.' "></i>
                            <span class="badge bg-dark">'.$total_vote.' </span>    
                        </a> 
                        <a style="cursor: pointer;" onclick="displayForm('.$comment_id.')" class="text-decoration-none mx-2">Reply</a>
                        '.$edit_code_comment.'
                    </small>
                    <form  style="display:none;" id="reply_form'.$comment_id.'" method="post" action=" '.$server_uri.'">
                        <div class="form-group my-2 ">
                            <input type="text" class="d-none" id="" name="comment_id" value="'.$comment_id.'">
                            <label for="">Write a Reply</label>
                            <textarea class="form-control my-1" id="" name="reply" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success my-2">Reply</button>
                    </form>
                   
            ';

            
            $sql_reply = "SELECT * FROM `comments` WHERE `reply_to` =".$comment_id;
            $result_reply = mysqli_query($conn,$sql_reply);

            while($rows_reply = mysqli_fetch_assoc($result_reply)){
                $reply_id = $rows_reply['comment_id'];
                $reply = $rows_reply['comment_content'];
                $reply_time = $rows_reply['comment_time'];
                $reply_by_id = $rows_reply['comment_by'];
                
                $sql_reply_user = "SELECT `user_email` FROM `users` WHERE `id` =".$reply_by_id;
                $result_reply_user = mysqli_query($conn, $sql_reply_user);
    
                $row_reply_user= mysqli_fetch_assoc($result_reply_user);
                $reply_by = $row_reply_user['user_email'];

                if(isset($_SESSION["userId"])){
                    $user_id = $_SESSION["userId"];
                    $vote_url_reply = '/forum/thread.php?thread_id='.$id.'&comment_id='.$reply_id.'&user_id='.$_SESSION["userId"];
    
                    $sql_isLiked = "SELECT * FROM `votes` WHERE `comment_id`='$reply_id' AND `user_id`= '$user_id'";
                    $result_isLiked = mysqli_query($conn, $sql_isLiked);
                    $isLiked = mysqli_num_rows($result_isLiked);
                    if($isLiked == 0){
                        $class_like = "secondary";
    
                    }else{
                        $class_like = "danger";
                    }
                }
                else{
                    $vote_url_reply = "#";
                    $class_like = "secondary";
                }

                $sql_count_vote = "SELECT * FROM `votes` WHERE `comment_id`='$reply_id' ";
                $result_count_vote = mysqli_query($conn, $sql_count_vote);
                $total_vote = mysqli_num_rows($result_count_vote);

                if(isset($_SESSION["userId"]) && $reply_by_id == $_SESSION["userId"]){
                    $edit_code_reply = '
                    <span style="">
                    <a href="/forum/update/update-comments.php?comment_id='.$reply_id .'&thread_id='.$id.'" class="text-decoration-none mx-1">
                        Edit
                    </a>
                    <a onclick="return confirm(`Are you sure?`)" href="/forum/update/update-comments.php?delete_id='.$reply_id.'&thread_id='.$id.'" class="text-decoration-none mx-1">
                        Delete
                    </a>
                    </span>
                    ';
                }
                else{
                    $edit_code_reply = "<span></span>";
                }

                echo'
                <div class="p-2">
                    <div class="ps-3 w-100">
                        <small class="my-1 text-muted "><i class="fa fa-user-circle text-primary me-1"></i>'.$reply_by.' at '.$reply_time.'  </small>
                        <h6 class="my-0 ">'.$reply.' </h6>
                        <small class="my-1  ">
                            <a href="'.$vote_url_reply.'" class="text-decoration-none  btn px-0">
                                <i style="font-size:24px" class="mx fa fa-heart text-'.$class_like.' "></i>
                                <span class="badge bg-dark">'.$total_vote.' </span>    
                            </a> 

                            '.$edit_code_reply.'
                        </small>
                    </div>
                </div>
                ';
            }

            echo'
                </div>
            </div>
            ';

        }

        if ($noResult) {
            echo'
            <div class="p-md-5 p-3  my-3 rounded _bg_thread">
                <h1 class="display-4">No Comment Found!</h1>
                <p class="lead">Be the first person to add Comment </p>
            </div>
            ';
        }
        ?>
    </div>

    <?php include 'partials/_footer.php' ?>

    <!--  JS Files -->
    <script>
        const displayForm = (comment_id)=>{
            let reply_form = "reply_form"+comment_id;
            let form = document.getElementById(reply_form);
            form.style.display = "block";
            console.log(reply_form);

        }
    </script>
    <script src='assets/bootstrap/js/bootstrap.bundle.js'></script>
    <script src='/forum/assets/js/app.js'></script>

</body>

</html>