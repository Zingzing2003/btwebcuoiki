<?php
    include('config.php');
    session_destroy();
    header("location:http://localhost/fitness_web/admin/login.php");
?>