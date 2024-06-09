<?php include('menu.php')?>
<div class="main-content">
    <div class="content" style="margin: auto;width: 50%;border: 1px solid grey;">
        <h1>Cập nhật đơn đăng kí</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_register WHERE id = $id";
                $connect = mysqli_connect('localhost','root','','fitness_course');
                $res = mysqli_query($connect,$sql);

                $count = mysqli_num_rows($res);
                if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $course = $row['course_name'];
                        $course_fee = $row['course_fee'];
                        $qty = $row['qty'];
                        $learner_name = $row['learner_name'];
                        $learner_email = $row['learner_email'];
                        $learner_address = $row['learner_address'];
                        $status = $row['status']; 
                        $learner_contact = $row['learner_contact'];
                }else{
                    $row = mysqli_fetch_assoc($res);
                }

            }else {
                header("Location:manage-register.php");
            }
        ?>

        <form action="" method="post">
            <table width="100%">
                <tr>
                    <td>Tên khóa học</td>
                    <td><?=$course;?></td>
                </tr>

                <tr>
                    <td>Giá</td>
                    <td><?=$course_fee;?></td>
                </tr>

                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input type="number" name="qty" value="$<?=$qty;?>">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Registered"){echo "selected";} ?> value="Ordered">Đăng kí thành công</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Tên khách hàng: </td>
                    <td>
                        <input type="text" name="learner_name" value="<?=$learner_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Liên hệ: </td>
                    <td>
                        <input type="text" name="learner_contact" value="<?=$learner_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="learner_email" value="<?=$learner_email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ khách hàng</td>
                    <td>
                        <textarea name="learner_address" cols="30" rows="5"><?=$learner_address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="hidden" name="course_fee" value="<?=$course_fee;?>">
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
        $course_fee = $_POST['course_fee'];
        $qty = $_POST['qty'];
        $id = $_POST['id'];
        $total = $course_fee * $qty;
        $learner_name = $_POST['learner_name'];
        $learner_email = $_POST['learner_email'];
        $learner_address = $_POST['learner_address'];
        $status = "Registered"; // đang order ,đang vận chuyển, vận chuyển xong, hủy 
        $learner_contact = $_POST['learner_contact'];  

        $sql2 = "UPDATE tbl_register SET
                qty = '$qty',
                total = $total,
                status = '$status',
                learner_name = '$learner_name',
                learner_contact = '$learner_contact',
                learner_email = '$learner_email',
                learner_address = '$learner_address'
                WHERE id = $id

        ";
         $connect = mysqli_connect('localhost','root','','fitness_course');
         $res2 = mysqli_query($connect,$sql2);
        
         if($res2==true){
            $_SESSION['update'] = "cập nhật đơn đăng kí thành công";
            header("Location:manage-register.php");
         }else{
            $_SESSION['update'] = "cập nhật đơn đăng kí thất bại";
            header("Location:manage-register.php");
         }
    }
?>