 <!-- slider starts here -->
 <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" style="" src="/forum/assets/img/slider/slider-1.jpg" alt="">
            </div>
            <div class="carousel-item">
                <img class="w-100" style="" src="/forum/assets/img/slider/slider-2.jpg" alt="">
            </div>
            <div class="carousel-item">
                <img class="w-100" style="" src="/forum/assets/img/slider/slider-3.jpg" alt="">
            </div>
        
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories container starts here -->
    <div class="container mt-3 py-5">
        <h2 class="text-center">iDiscuss - Browse Categories</h2>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 mt-3 justify-content-center">
            <!-- Fetch all the Categories -->
            <?php

            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                $cat_img = $row['cat_img'];

                if ($cat_img == NULL) {
                    $cat_img_code = '
                            <i style="font-size:180px" class="fa fa-code"></i>
                    ';
                }else{
                    $cat_img_code=  '<img class="img-fluid" src="/forum'.$cat_img.'" alt="">';
                    
                }

                echo '
                     <div class="col">
                        <div class="card h-100">
                            <a class="text-decoration-none text-dark text-center" href="/forum/threadlist.php?catid='.$id.'">
                            '.$cat_img_code.'
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"> <a class="text-decoration-none text-justify" href="/forum/threadlist.php?catid='.$id.'">  '.$cat.'</a></h5>
                                <p class="card-text">'.substr($desc,0,60).'...</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div>
                     </div>
                ';
            }
            ?>
        </div>
    </div>