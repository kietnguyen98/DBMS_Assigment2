<?php
include('DBstart.php');
session_start();
$error = array();

if(isset($_POST['loginButton'])){
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $check_query="select * from account where username='$user_name' and password='$password'";
    $check_login_result = mysqli_query($connect_handle,$check_query);
    if(mysqli_num_rows($check_login_result) > 0 ){
        //check co => dang nhap thanh cong
        
        $select_name_query = "select last_name, middle_name, first_name from scientist, account where account.username='$user_name' and scientist.id = account.id";
        $select_name_result = mysqli_query($connect_handle, $select_name_query);
        $data = mysqli_fetch_assoc($select_name_result);
        $username = $data['last_name']." ".$data['middle_name']." ".$data['first_name'];
        $_SESSION['username'] = $username;
        $select_role_query = "select * from account where username='$user_name' and id in (select id from editor)";
        $select_role_result = mysqli_query($connect_handle, $select_role_query);
        if(mysqli_num_rows($select_role_result) == 1){
            $_SESSION['role'] = 'editor';
        }
        header('location: Client/homepage.php');
        exit();
    }else{
        array_push($error, "Sai tên đăng nhập hoặc mật khẩu");
        echo 
            "<script>
                $(window).on('load', function () {
                    $('#error-modal').modal('show');
                });
            </script>";
    }
};

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location: ../SignIn/index.php');
}
?>
