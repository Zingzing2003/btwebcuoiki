<?php include('menu.php'); ?>
<div class="main-content">
    <div class="content" style="margin: auto;width: 50%;border: 1px solid grey;">
        <h1>Thêm khóa học</h1>
        <br><br>
        
        <?php
            if(isset($_SESSION['$upload'])){
                echo $_SESSION['$upload'];
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table style="width:100%;">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tên khóa học">
                    </td>
                </tr>

                <tr>
                    <td>Giới thiệu: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Giới thiệu khóa học"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="course_fee">
                    </td>
                </tr>

                <tr>
                    <td>Ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Bộ môn: </td>
                    <td>
                        <select name="category">
                        <?php
                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                    $connect = mysqli_connect('localhost','root','','fitness_course');
                    $res = mysqli_query($connect,$sql);

                    $count =mysqli_num_rows($res);
                    if($count > 0){
                        // có bộ môn
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                                <option value="<?=$id?>"><?php echo $title ?></option>
                            <?php
                        } 
                    }else{
                        // không có bộ môn
                        ?>
                        <option value="0">Không tồn tại bộ môn khóa học</option>
                        <?php
                    }
                ?>
                        </select>
                    </td>
                </tr>

              

                <tr>
                    <td>Yêu thích: </td>
                    <td>
                        <input type="radio" name="featured">Có
                        <input type="radio" name="featured">Không
                    </td>
                </tr>

                <tr>
                    <td>Kích hoạt: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Có
                        <input type="radio" name="active" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary" style="border:none;">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('footer.php') ?>
<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $course_fee = $_POST['course_fee'];
        $category = $_POST['category'];
        
        // check 2 nút yêu thích và kích hoạt đực click hay chưa
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = 'No';
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = 'No';
        }
        // check ảnh
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/course/".$image_name;

            //upload ảnh
            $upload = move_uploaded_file($source_path,$destination_path);
            if($upload==false){
                $_SESSION['upload'] = "Upload ảnh thất bại";
                header("Location: manage-category.php");
                // dừng quá trình upload
                die();
            }
        }else{
            $image_name ="";
        }

        // insert data
        $sql2 = "INSERT INTO tbl_course SET
                title = '$title',
                description = '$description',
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active',
                course_fee = '$course_fee'
        ";
         $connect = mysqli_connect('localhost','root','','fitness_course');
         $res2 = mysqli_query($connect,$sql2);

        // check insert 
        if($res2 == True){
            $_SESSION['add'] = 'thêm khóa học thành công';
            header("Location: manage-course.php");
        }else{
            $_SESSION['add'] = 'thêm khóa học thất bại ';
            header("Location: manage-course.php");
        }
    }
?>