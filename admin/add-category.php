<?php include('menu.php'); ?>
<div class="main-content">
    <div class="content" style="margin: auto;width: 50%;border: 1px solid grey;">

        <h1 style="text-align: center;">Thêm bộ môn</h1>
        <br><br>

        <?php
            if(isset($_SESSION['$upload'])){
                echo $_SESSION['$upload'];
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table width="100%" class="tbl">
                <tr>
                    <td>Tiêu đề: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tiêu đề">
                    </td>
                </tr>
                
                <tr>
                    <td>Chọn ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Có
                        <input type="radio" name="featured" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>Kích hoạt: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Có
                        <input type="radio" name="active" value="No">không
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm" class="btn btn-secondary" style="border: none;">
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

        // check radio input
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            // đặt giá trị mặc định
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            // đặt giá trị mặc định
            $active = "No";
        }

        // check ảnh được submit chưa
        if(isset($_FILES['image']['name'])){
            //upload ảnh
            // để upload ảnh thì cần tên ảnh, source path và destination path
            $image_name = $_FILES['image']['name'];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
            
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

        $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name = '$image_name',
                featured='$featured',
                active='$active'
        ";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);
        if($res==TRUE){
            $_SESSION['add'] = "Thêm bộ môn thành công";
            header("Location: manage-category.php");
        }else {
            $_SESSION['add'] = "Thêm bộ môn thất bại";
            header("Location: manage-category.php");
        }
    }
?>
<?php include('footer.php'); ?>
