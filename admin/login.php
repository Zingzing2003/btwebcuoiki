<?php include('config.php');?>
<html>
    <head>
        <title>Đăng nhập - fitness_web system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1>Đăng nhập</h1>
            <br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br>
            <form action="" method="post" class="text-centr">
            Username: <br>
            <input type="text" name="username" placeholder="Nhập tên đăng nhập">
                <br>
            Password: <br>
            <input type="password" name="password" placeholder="Nhập mật khẩu" >
               <br><br>
            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary">
            <br><br>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql="SELECT * FROM tbl_admin WHERE username ='$username' AND password ='$password'";
        $connect = mysqli_connect('localhost','root','','fitness_course');
        $res = mysqli_query($connect,$sql);
        
        // đếm row để xem usern có tồn tại hay không
        $count = mysqli_num_rows($res);

        if($count==1){
            // đăng nhập thành công
           // $_SESSION['login'] = "đăng nhập thành công";
            header("Location: manage-admin.php");
        }else {
          
            $_SESSION['login'] = "<div style='color: red; font-size: smaller;'>Đăng nhập thất bại do sai tên đăng nhập hoặc mật khẩu</div>";
        }
    }
?>