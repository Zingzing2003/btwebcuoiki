<?php include('menu.php')?>
    <!--  menu -->
    <section class="course-search text-center">
        <div class="container">
            
            <form action="course-search.html" method="POST">
                <input type="search" name="search" placeholder="Tìm kiếm khóa học.." required>
                <input type="submit" name="submit" value="Tìm" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!--  menu  -->
    <section class="course-list">
        <div class="container">
            <h2 class="text-center">Khóa học </h2>

            <?php
                $sql = "SELECT * FROM  tbl_course WHERE active='Yes'";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res = mysqli_query($connect,$sql);
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id =  $row['id'];
                        $title = $row['title'];
                        $course_fee = $row['course_fee'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="course-list-box">
                            <div class="course-list-img">
                                <?php
                                    if($image_name==""){
                                        echo "không có ảnh khóa học";
                                    }else{
                                        ?>
                                        <img src="images/course/<?=$image_name;?>" class="img-responsive img-curve">
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
                }else{
                    echo "không có khóa học trong db";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('footer.php')?>
