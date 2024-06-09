<?php include('menu.php');?>

<?php
    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
        $sql = "SELECT * FROM tbl_course WHERE id = $course_id";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);

        $count = mysqli_num_rows($res);
        if($count==1){
            // có data 
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $course_fee = $row['course_fee'];
            $image_name = $row['image_name'];
        }else{
           
            header("Location:index.php");
        }
    }else{
        header("Location:index.php");
    }
?>
<!--  search-->
<section class="course-container">
    <div class="container">
        
        <h2 class="text-center text-white">Điền vào form để đặt khóa học .</h2>

        <form action="" method="post" class="register">
            <fieldset>
                <legend>Khóa học được chọn</legend>

                <div class="course-list-img">
                    <?php
                    
                    if($image_name==""){
                        echo "ảnh k tồn tại";

                    }else{
                    ?>
                        <img src="images/course/<?=$image_name;?>" class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                    
                </div>

                <div class="course-list-desc">
                    <h3><?=$title;?></h3>
                    <input type="hidden" name="course" value="<?=$title;?>">

                    <p class="course-course_fee"><?=$course_fee?></p>
                    <input type="hidden" name="course_fee" value="<?=$course_fee;?>">

                    <div class="register-label">Số lượng</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend>Chi tiết đơn đăng kí</legend>
                <div class="register-label">Họ và tên</div>
                <input type="text" name="full-name" placeholder="Họ và tên của bạn" class="input-responsive" required>

                <div class="register-label">Sđt</div>
                <input type="tel" name="contact" placeholder="Sđt" class="input-responsive" required>

                <div class="register-label">Email</div>
                <input type="email" name="email" placeholder="Email của bạn" class="input-responsive" required>

                <div class="register-label">Địa chỉ</div>
                <textarea name="address" rows="10" placeholder="Địa chỉ" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Đăng kí" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<?php
if(isset($_POST['submit'])){
    $course = $_POST['course'];
    $course_fee = $_POST['course_fee'];
    $qty = $_POST['qty'];

    $total = $course_fee * $qty;
    $register_date = date("Y-m-d h:i:sa");
    $learner_name = $_POST['full-name'];
    $learner_email = $_POST['email'];
    $learner_address = $_POST['address'];
    $status = "Registered";  
    $learner_contact = $_POST['contact'];
    $sql2 = "INSERT INTO tbl_register SET
            course_name = '$course',
            course_fee = $course_fee,
            qty = $qty,
            total = $total,
            register_date = '$register_date',
            status = '$status',
            learner_name = '$learner_name',
            learner_contact = '$learner_contact',
            learner_email = '$learner_email',
            learner_address = '$learner_address'
    ";
     $connect = mysqli_connect('localhost','root','','fitness_course');
     $res2 = mysqli_query($connect,$sql2);

     if($res2==true){
        $_SESSION['register'] = "Đăng kí thành công";
        header("Location: index.php");
     }else {
        $_SESSION['register'] = "Đăng kí thất bại";
        header("Location: index.php");
     }

}

?>
<?php include('footer.php');?>
