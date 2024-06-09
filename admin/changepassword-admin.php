<?php
    include('menu.php');
?>
<div class="main-content">
    <div class="content" style="margin: auto;width: 40%;border: 1px solid grey;">
        <h1 style="text-align: center;">Đổi mật khẩu</h1>
        <br><br>
        <?php
            $id= $_GET['id'];
        ?>
        <form action="" method="post">
            <table width="100%" class="">
                <tr>
                    <td>Mật khẩu hiện tại: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Mật khẩu cũ">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu mới: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td>Xác thực mật khẩu</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="submit" name="submit" value="Đổi mật khẩu" class="btn btn-primary" style="border:none;">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<?php include('footer.php') ?>
<?php
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $current_password =$_POST['current_password'];
        $new_password =$_POST['new_password'];
        $confirm_password =$_POST['confirm_password'];

        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);

        if($res==TRUE){
            $count= mysqli_num_rows($res);
            if($count==1){
              if($new_password==$confirm_password){
                $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                ";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res2 = mysqli_query($connect,$sql2);
                $_SESSION['change_password_success'] = "đổi mật khẩu thành công";
                header("Location: manage-admin.php");
              }else{
                $_SESSION['password_not_match'] = "mật khẩu nhập lại không khớp";
                header("Location: manage-admin.php");
              }
            }else{
                $_SESSION['user_not_found'] = "không tìm thấy admin";
                header("Location: manage-admin.php");
            }
        }

    }
?>