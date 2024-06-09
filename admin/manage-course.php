<?php include('menu.php'); ?>
<!-- Latest compiled and minified CSS -->
        <div class="wrapper">
            <h1>Quản lý khóa học</h1>
            <br/><br/>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload'])){
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
            }
            // Kiểm tra và hiển thị thông báo cập nhật nếu có
            if(isset($_SESSION['update'])){
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }
        ?>
        <br><br>
            <a href="http://localhost/fitness_web/admin/add-course.php" class="btn btn-primary">Thêm khóa học</a>
              <br/><br/>
              <table class="tbl-full">
                <tr>
                  <th>Stt</th>
                  <th>Tên khóa học</th>
                  <th>Giá</th>
                  <th>Ảnh</th>
                  <th> Số bài học</th>
                  <th>Yêu thích</th>
                  <th>Kích hoạt</th>
                  <th>Tùy chọn</th>
                </tr>

                <?php
                  $sql = "SELECT * FROM tbl_course";
                  $connect = mysqli_connect('localhost','root','','fitness_course');
                  $res = mysqli_query($connect,$sql);

                  $count = mysqli_num_rows($res);
                  $stt = 1;
                  if($count > 0){
                    // có course trong db
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $course_fee = $row['course_fee'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        $lesson_number= $row['lesson_number']

                        ?>
                          <tr>
                            <td><?=$stt++;?></td>
                            <td><?=$title;?></td>
                            <td><?=number_format($course_fee, 0, '', '.')?> VNĐ</td>
                            <td>
                              <?php
                                // check ảnh 
                                if($image_name!=""){
                                  ?>
                                  <img src="../images/course/<?=$image_name?>" width="100px">  
                                  <?php
                                }
                              ?>
                            </td>
                            <td> <?=$lesson_number?></td>
                            <td><?php if($featured == "Yes"){echo "Có";} else {echo "Không";}?></td>
                            <td><?php if($active == "Yes"){echo "Có";} else {echo "Không";}?></td>
                            <td>
                            <a href="http://localhost/fitness_web/admin/update-course.php?id=<?=$id;?>" class="btn btn-secondary">Cập nhật</a>
                            <a href="http://localhost/fitness_web/admin/delete-course.php?id=<?=$id;?>&image_name=<?=$image_name;?>" class="btn btn-danger">Xóa</a>
                            </td>
                          </tr>
                        <?php
                    }
                  }else{
                    // k có course trong fb
                    echo "Khóa học chưa được thêm";
                  }
                ?>
              
              </table>
        </div>
    </div>

<?php include('footer.php'); ?>
