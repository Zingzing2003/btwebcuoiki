<?php include('menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Quản lý đơn đăng kí</h1>
            <br/><br/>
  
              <br/><br/>
              <?php
                if(isset($_SESSION['update'])){
                  echo $_SESSION['update'];
                  unset($_SESSION['update']);
                }
              ?>
              <table class="tbl-full">
                <tr>
                  <th>Stt</th>
                  <th>Tên </th>
                  <th>Giá </th>
                  <th>Số lượng</th>
                  <th>Tổng</th>
                  <th>Ngày đặt</th>
                  <th>Trạng thái</th>
                  <th>Tên khách hàng</th>
                  <th>Liên hệ</th>
                  <th>Email</th>
                  <th>Địa chỉ</th>
                  <th>Tùy chọn</th>
                </tr>

                <?php
                  $sql ="SELECT * FROM tbl_register";
                  $connect = mysqli_connect('localhost','root','','fitness_course');
                  $res = mysqli_query($connect,$sql);
                  $count = mysqli_num_rows($res); 
                  $stt= 1;
                  if($count > 0 ){
                      while($row= mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $course = $row['course_name'];
                        $course_fee = $row['course_fee'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $register_date = $row['register_date'];
                        $learner_name = $row['learner_name'];
                        $learner_email = $row['learner_email'];
                        $learner_address = $row['learner_address'];
                        $status = $row['status'];  
                        $learner_contact = $row['learner_contact'];

                        ?>
                          <tr>            
                              <td><?=$stt++;?></td>
                              <td><?=$course;?></td>
                              <td><?=number_format($course_fee, 0, '', '.')?> VNĐ</td>
                              <td><?=$qty;?></td>
                              <td><?=number_format($total, 0, '', '.')?> VNĐ</td>
                              <td><?=$register_date;?></td>
                              <td><?php if($status == "Registered"){echo "Đăng kí thành công";}
                                       
                              ?></td>
                              <td><?=$learner_name;?></td>
                              <td><?=$learner_contact;?></td>
                              <td><?=$learner_email;?></td>
                              <td><?=$learner_address;?></td>
                              <td>
                              <a href="http://localhost/fitness_web/admin/update-register.php?id=<?=$id;?>" class="btn btn-secondary">Cập nhật</a>
                              </td>
                          </tr>
                        <?php
                      }
                  }else{  
                    echo "Không có đơn đăng kí";
                  }
                ?>

                
              </table>
        </div>
    </div>

<?php include('footer.php'); ?>
