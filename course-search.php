<?php include('menu.php')?>

    <!--  search -->
    <section class="course-search text-center">
        <div class="container">
            
        <?php
            $search = $_POST['search']
        ?>
            <h1 class="text-white"style="color:black">Kết quả tìm kiếm mkhóa học <a href="#" class="text-white">"<?=$search?>"</a></h2>

        </div>
    </section>



    <!--  menu -->
    <section class="course-list">
        <div class="container">
            <h2 class="text-center">Khóa học </h2>

            <?php
                $search = $_POST['search'];
                $sql = "SELECT * FROM tbl_course WHERE title LIKE '%$search%'";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res = mysqli_query($connect,$sql);

                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row=mysqli_fetch_assoc($res)){
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
                                        echo "Ảnh khóa học không tồn tại";
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
                                <a href="#" class="btn btn-primary">Đăng kí ngay</a>
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