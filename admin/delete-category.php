<?php
    include('config.php');
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['$image_name'];
        
        // xử lý xóa ảnh
        if($image_name!=""){
            $path = ".../images/category/".$image_name;
            // xóa ảnh khỏi folder
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['remove'] = "Xóa ảnh không thành công";
                header("Location: manage-category.php");
                // dừng quá trình xóa ảnh
                die();
            }
        }

        //sql
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);


        if($res==true){
            $_SESSION['delete'] = 'Xóa bộ môn thành công';
            header("Location: manage-category.php");
        }else{
            $_SESSION['delete'] = 'Xóa bộ môn thất bại';
            header("Location: manage-category.php");    
        }

    }else{
        echo "Xóa không thành công do thiếu dữ liệu đầu vào";
        header("Location: manage-category.php");
    }
?>