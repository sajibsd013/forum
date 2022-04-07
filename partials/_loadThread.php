<?php include '_dbconnect.php' ?>

<div class="container my-5">
    <h2 class="my-3">Browse Questions</h2>
    <?php
        $id= $_GET['catid'];

    $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` =".$id;
    $result = mysqli_query($conn,$sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $timestand = $row['timestand'];
        $id = $row['thread_id'];
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

        echo'
        <div class="justify-content-between my-3">
            <h6 class="my-0"> 
            <a class="text-decoration-none" href="/forum/thread.php?thread_id='.$id.'">  '.$thread_title.'</a>
            <span class="badge bg-'.$class.'">'.$badge.'</span>
            </h6> 
            <small class=" text-muted my-1">asked by '.$user_email.' '.$timestand.' </small>
        </div>
        ';
    }

    if ($noResult) {
        echo'
        <div class="p-md-5 p-3  my-3 rounded _bg_thread">
            <h1 class="display-4">No Threads Found!</h1>
            <p class="lead">Be the first person to ask question </p>
        </div>
        ';
    }

    ?>
</div>