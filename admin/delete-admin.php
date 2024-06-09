<?php
    include('config.php');
    $id = $_GET['id'];
    echo $id;
    
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $connect = mysqli_connect('localhost','root','','fitness_course');
    $res = mysqli_query($connect,$sql);

    if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'>Xóa admin thành công</div>";
        header("Location: manage-admin.php");
    }else{
        $_SESSION['delete'] = "<div class='error'>Xóa admin thất bại</div>";
        header("Location: manage-admin.php");
    }
?>