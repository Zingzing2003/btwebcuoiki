<?php include('menu.php');?>



    <!-- category-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám phá bộ môn thể hình </h2>
            
            <?php
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res = mysqli_query($connect,$sql);

                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row= mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                    ?>
                    <a href="http://localhost/fitness_web/category-courses.php?category_id=<?=$id;?>">
                         <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "Không có ảnh";
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
                }else{
                    echo "Không có bộ môn";
                }

            ?>

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    


<?php include('footer.php')?>