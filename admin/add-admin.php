
<?php include('menu.php') ?>
<div class="main-content">
    <div class="content" style="margin: auto;width: 50%;border: 1px solid grey;">
        <h1 >Thêm Admin</h1>

        <form action="" method="post">
            <table width="100%" class="tbl">
                <tr>
                    <td>Họ và Tên: </td>
                    <td><input type="text" name="full_name" placeholder="Nhập họ và tên"></td>
                </tr>

                <tr>
                    <td>Tên đăng nhập: </td>
                    <td><input type="text" name="username" placeholder="Nhập tên đăng nhập"></td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="password" placeholder="Nhập mật khẩu"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm Admin" class="btn btn-primary" style="border:none;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('footer.php') ?>


<?php
    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];        
    
    $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
            ";

    $connect = mysqli_connect('localhost','root','','fitness_course');
    $res = mysqli_query($connect,$sql);
    if($res==TRUE){
        $_SESSION['add'] = "<div class='success'>Thêm Admin thành công</div>";
        header("Location: manage-admin.php");
    }else {
        $_SESSION['add'] = "<div class='error'>Thêm admin thất bại</div>";
        header("Location: manage-admin.php");
    }
    }
?>
