<?php include('menu.php');?>
<?php
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }else{
       
    }
?>
    <!-- course search  -->
    <section class="course-search text-center">
        <div class="container">


            <h2>Khóa học  <a href="#" class="text-white">"<?=$category_title?>"</a></h2>

        </div>
    </section>


    <!-- course menu -->
    <section class="course-list">
        <div class="container">
            <h2 class="text-center">Khóa học </h2>
            <?php
                $sql2= "SELECT * FROM tbl_course WHERE category_id=$category_id";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res2 = mysqli_query($connect,$sql2);

                $count2 = mysqli_num_rows($res2);
                if($count2 > 0){
                    while($row2 = mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $course_fee = $row2['course_fee'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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