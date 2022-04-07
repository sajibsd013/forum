<?php
include '_dbconnect.php';
session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true && $_SESSION["userType"]=="admin") {

        echo'
        <div class=" bg-dark">
            <div class="container  justify-content-end d-flex">
                <a href="/forum/admin/admin.php" class="btn btn-light my-2">Admin Dashboard</a>
            </div>
        </div>

        ';

    }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" style="cursor: pointer;" onclick="router('/forum/index.php')" >
                    iDisscuss
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                    </li>
                    <li class="nav-item">
                        <a 
                        class="nav-link" 
                        style="cursor: pointer;" 

                        onclick="router('/forum/about.php')"
                        >About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Top Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                            $sql = "SELECT * FROM `categories` LIMIT 10";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['category_id'];
                                $cat = $row['category_name'];
                                echo '
                                    <li>
                                        <a 
                                        class="dropdown-item" 
                                        style="cursor: pointer;" 
                                        onclick="router(`/forum/threadlist.php?catid='.$id.'`)"
                                        >'.$cat.'</a>
                                    </li>
                                ';
                            }
                        ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;" onclick="router('/forum/contact.php/')">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" id="SearchForm">
                    <input class="form-control me-2" name="search" type="search" id="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-search "></i>
                    </button>
                </form>
 
            </div>
            <div class="div mx-2 my-2 my-md-0">
            <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {

                    $user_name = $_SESSION["userName"];

                    echo'
                        <span class="dropdown text-light">
                            <button class="dropdown-toggle btn btn-light" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user-circle text-primary me-1"></i>

                            </button>
                            <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="">
                                <a 
                                class="dropdown-item" 
                                style="cursor: pointer;" 
                                onclick="router(`/forum/profile.php`)" 
                                    >View profile </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/forum/partials/_logout.php"> Logout</a>
                            </ul>
                        </span>
                    ';
                }else {
                    echo'
                    <button class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#loginmodal">Login</button>

                    <button class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#signupmodal">Signup</button>
                    ';
                }
            ?>
        </div>

        </div>
       
    </nav> 





<script type="text/javascript">



</script>

<?php include '_signupModal.php' ?>
<?php include '_loginModal.php' ?>

<?php
    
    if(isset($_GET['error'])) {
        echo'
        <div class="alert alert-warning  alert-dismissible fade show my-0" role="alert">
            <strong>warning ! </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>   
        ';
    }

    if (isset($_GET['success'])) {
        echo'
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            '.$_GET['success'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>   
    ';
    
    }
    

?>

