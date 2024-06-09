<?php include('menu.php');?>

<?php
    /// Kiểm tra xem tham số 'id' có được thiết lập trong URL không
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql2 ="SELECT * FROM tbl_course WHERE id=$id";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res2 = mysqli_query($connect,$sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $description = $row2['description'];
        $current_category = $row2['category_id'];
        $current_image = $row2['image_name'];
        $title = $row2['title'];
        $course_fee = $row2['course_fee'];
        $featured = $row2['featured'];
        $active = $row2['active'];
 
    }
?>

<div class="main-content">
    <div class="content" style="margin: auto;width: 50%;border: 1px solid grey;">
        <h1 style="text-align: center;">Cập nhật khóa học</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table width="100%">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tên khóa học" value="<?=$title?>">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?=$description?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="course_fee" value="<?=$course_fee?>">
                    </td>
                </tr>

                <tr>
                    <td>Ảnh hiện tại: </td>
                    <td>
                        <?php
                            if($current_image==""){
                                echo "Ảnh không tồn tại";
                            }else {
                                ?>
                                <img src="../images/course/<?=$current_image;?>" width="100px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Chọn ảnh mới: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Bộ môn: </td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                                $connect = mysqli_connect('localhost','root','','fitness_course');
                                $res = mysqli_query($connect,$sql);

                                $count = mysqli_num_rows($res);
                                if($count > 0){
                                    // category có data
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>
                                        <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?=$category_id;?>"><?=$category_title?></option>
                                        <?php
                                    }
                                }else{
                                    echo "tbl_category không có data";
                                }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Yêu thích: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Có
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>Hiển thị: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Có
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="hidden" name="current_image" value="<?=$current_image;?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary" style="border:none;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('footer.php') ?>
<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $course_fee = $_POST['course_fee'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // ảnh
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            if($image_name != ""){
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
                // gỡ ảnh cũ
                if($current_image!=""){
                    $remove_path = "../images/course/".$current_image;
                    $remove = unlink($remove_path);
                }
            } else {
                // Nếu không có ảnh mới được chọn, giữ nguyên ảnh cũ
                $image_name = $current_image;
            }
        } else {
            // Nếu không có tệp ảnh mới được chọn, giữ nguyên ảnh cũ
            $image_name = $current_image;
        }

        $sql3 = "UPDATE tbl_course SET
                title='$title',
                description =  '$description',
                course_fee = $course_fee,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id;
            " ;
         $connect = mysqli_connect('localhost','root','','fitness_course');
         $res3 = mysqli_query($connect,$sql3);

         if($res3==True){
            $_SESSION['update'] = 'update khóa học thành công';
            header("Location: manage-course.php");
        }else{
            $_SESSION['update'] = 'update khóa học thất bại ';
            header("Location: manage-course.php");
        }

    }
?>