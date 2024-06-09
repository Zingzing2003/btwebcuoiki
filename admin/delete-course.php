<?php
    include('config.php');
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['$image_name'];
        
        // xử lý xóa ảnh
        if($image_name!=""){
            $path = ".../images/course/".$image_name;
            // xóa ảnh khỏi folder
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['upload'] = "Xóa ảnh không thành công";
                header("Location: manage-course.php");
                // dừng quá trình xóa ảnh
                die();
            }
        }

        //sql
        $sql = "DELETE FROM tbl_course WHERE id=$id";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);


        if($res==true){
            $_SESSION['delete'] = 'Xóa khóa học thành công';
            header("Location: manage-course.php");
        }

    }else{
        echo "Xóa không thành công do thiếu dữ liệu đầu vào";
        header("Location: manage-course.php");
    }
?>