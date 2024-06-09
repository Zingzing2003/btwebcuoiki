
 <?php include('menu.php'); ?>   
        <!-- main content -->
        <div class="main-content">
            <div class="wrapper">
              <h1>Quản lý Admin</h1>
              <br/>

              <?php
                if(isset($_SESSION['add'])){
                  echo $_SESSION['add']; 
                  unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete']; 
                  unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                  echo $_SESSION['update']; 
                  unset($_SESSION['update']);
                }
                if(isset($_SESSION['password_not_match'])){
                  echo $_SESSION['password_not_match']; 
                  unset($_SESSION['password_not_match']);
                }
                if(isset($_SESSION['user_not_found'])){
                  echo $_SESSION['user_not_found']; 
                  unset($_SESSION['user_not_found']);
                }
                if(isset($_SESSION['change_password_success'])){
                  echo $_SESSION['change_password_success']; 
                  unset($_SESSION['change_password_success']);
                }
              ?>
              <br><br/>
              <br/>
              <a href="add-admin.php" class="btn btn-primary">Thêm Admin</a>
              <br/><br/>
              <table class="tbl-full">
    <tr>
        <th>Stt</th>
        <th>Họ và Tên</th>
        <th>Tên người dùng</th>
        <th>Tùy chọn</th>
    </tr>
    
    <?php
    //bảng admin
    $sql ="SELECT * FROM tbl_admin";
    // thực hiện sql
    $connect = mysqli_connect('localhost','root','','fitness_course');
    $res = mysqli_query($connect,$sql);

    // check
    if($res==TRUE){
        $count = mysqli_num_rows($res); // lấy hết các hàng trong database
        $num = 1;
        if($count > 0){
            while($rows = mysqli_fetch_assoc($res)){
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $username = $rows['username'];
                $password = $rows['password']; 
                ?>
                
                <!-- hiển thị dữ liệu -->
                <tr>
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                        <a href="http://localhost/fitness_web/admin/changepassword-admin.php?id=<?=$id;?>" class="btn btn-primary">Đổi mật khẩu</a>
                        <a href="http://localhost/fitness_web/admin/update-admin.php?id=<?=$id;?>" class="btn btn-secondary">Cập nhật</a>
                        <a href="http://localhost/fitness_web/admin/delete-admin.php?id=<?=$id;?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "<tr><td colspan='4'>Không có dữ liệu để hiển thị</td></tr>";
        }
    }
    ?>
</table>
            </div>
        </div>
        
<?php include('footer.php'); ?>