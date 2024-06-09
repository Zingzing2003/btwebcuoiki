
 <?php include('menu.php');?>

    <!--  search -->
    <section class="course-search text-center">
        <div class="container">
            
            <form action="http://localhost/fitness_web/course-search.php" method="POST">
                <input type="search" name="search" placeholder="Tìm kiếm khóa học.." required>
                <input type="submit" name="submit" value="Tìm" class="btn btn-primary">
            </form>

        </div>
    </section>
   
    <?php
        if(isset($_SESSION['register'])){
            echo $_SESSION['register'];
            unset($_SESSION['register']);
        }
    ?>

    <!-- category  -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám phá bộ môn thể hình</h2>

            <?php
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res = mysqli_query($connect,$sql);

                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="http://localhost/fitness_web/category-courses.php?category_id=<?=$id;?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "file ảnh không khả dụng";
                                }else{
                                    ?>
                                        <img src="images/category/<?=$image_name?>" alt="Gym" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                            <h3 class="float-text text-white"><?=$title?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <section class="course-list">
        <div class="container">
            <h2 class="text-center" >Khóa học nổi bật </h2>
            <?php
                $sql2 = "SELECT * FROM tbl_course WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res2 = mysqli_query($connect,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2 > 0){
                    while($row=mysqli_fetch_assoc($res2)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $course_fee = $row['course_fee'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>       
                    <div class="course-list-box">
                        <div class="course-list-img">
                           <?php
                                if($image_name==""){
                                    echo "không có file ảnh";
                                }else{
                                    ?>
                                        <img src="images/course/<?=$image_name?>"  class="img-responsive img-curve">
                                    <?php
                                }
                           ?>
                         </div>
                        <div class="course-list-desc">
                            <h4><?=$title;?></h4>
                            <p class="course-course_fee"><?=number_format($course_fee, 0, '', '.');?> VNĐ</p>
                            <p class="course-detail">
                                <?=$description;?>
                            </p>
                            <br>
                            <a href="http://localhost/fitness_web/register.php?course_id=<?=$id;?>" class="btn btn-primary">Đăng kí ngay</a>
                        </div>
                    </div>
                        <?php
                    }
                }
            ?>
            <div class="clearfix"></div>
        </div> 
    </section>

<?php include('footer.php');?>