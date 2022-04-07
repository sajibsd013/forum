<?php
include '../partials/_dbconnect.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["userType"]!="admin") {
    header("Location: /forum/index.php");
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/forum/admin/admin.php">
                iDisscuss admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" class="list-group-item" href="/forum/admin/users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" class="list-group-item" href="/forum/admin/threads.php">Threads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" class="list-group-item" href="/forum/admin/comments.php">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/forum/admin/categories.php">Categories</a>
                    </li>

            </ul>
                              

                    
                <div class=" ms-auto my-2 my-md-0">
                    <?php
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
                            $user_name = $_SESSION["userName"];

                            echo'
                            <small class="text-light">Welcome '.$user_name.'</small>
                            <a href="/forum/index.php" class="btn btn-light"> View site</a>
                            <a href="/forum/partials/_logout.php" class="btn btn-light"> Logout</a>
                            ';

                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<?php

if (isset($_GET['success'])) {
    echo'
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        '.$_GET['success'].'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>   
';

}

?>
