<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý bộ môn</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>
        <br><br>
        <a href="http://localhost/fitness_web/admin/add-category.php" class="btn btn-primary">Thêm bộ môn</a>
        <br/><br/>
        <table class="tbl-full">
            <tr>
                <th>Stt</th>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
                <th>Nổi bật</th>
                <th>Kích hoạt</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_category";
                $connect = mysqli_connect('localhost', 'root', '', 'fitness_course');
                $res = mysqli_query($connect, $sql);
                $count = mysqli_num_rows($res);
                $stt = 1; // Số thứ tự

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
            ?>
                        <tr>
                            <td><?=$stt++;?></td>
                            <td><?=$title;?></td>
                            <td>
                              <?php
                                // check ảnh có trong db hay chưa
                                if($image_name!=""){
                                  ?>
                                  <img src="../images/category/<?=$image_name?>" width="100px">  
                                  <?php
                                }
                              ?>
                            </td>
                            <td><?php if($featured == "Yes"){echo "Có";} else {echo "Không";}?></td>
                            <td><?php if($active == "Yes"){echo "Có";} else {echo "Không";}?></td>
                            <td>
                                <!-- <a href='update-category.php?id=<?=$id;?>' class='btn btn-secondary'>Cập nhật</a> -->
                                <a href='http://localhost/fitness_web/admin/delete-category.php?id=<?=$id;?>&image_name=<?=$image_name;?>' class='btn btn-danger'>Xóa</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='error'>Không có dữ liệu bộ môn.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
