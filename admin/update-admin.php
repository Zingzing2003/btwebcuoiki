<?php include('menu.php');?>

<div class="main-content">
    <div class="content" style="margin:30px auto;width: 50%;border: 1px solid grey;">
        <h1 style="text-align: center;">Cập nhật Admin</h1>

        <br><br>

        <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $connect = mysqli_connect('localhost','root','','fitness_course');
            $res = mysqli_query($connect,$sql);
            // check câu query có đc thực thi hay không 
            if($res==TRUE){
                // check tồn tại data
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];

                }
            }
        ?>
        <!-- truyền data lấy từ id vào form -->
        <form action="" method="post">

            <table width= "100%" class="tbl">
                <tr>
                    <td>Họ và tên: </td>
                    <td>
                        <input type="text" name="full_name" value="<?=$full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Tên đăng nhập: </td>
                    <td>
                        <input type="text" name="username" value="<?=$username;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-secondary" style="border: none;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('footer.php') ?>
<?php
    // check nút submit được click hay chưa
    if(isset($_POST['submit'])){
        // lấy data từ form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //update sql
        $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'
                ";

        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);

        if($res==True){
            $_SESSION['update'] = 'Cập nhật admin thành công';
            header("Location: manage-admin.php");
        }else {
            $_SESSION['update'] = 'Cập nhật admin thất bại';
            header("Location: manage-admin.php");
        }
    }
?>