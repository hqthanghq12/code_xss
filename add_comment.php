<?php
session_start();
include_once "model.php";
// Kiểm tra xem người dùng đã đăng nhập chưa
//if (isset($_SESSION['username'])) {
   $username ='333';
//    $isLoggedIn = true;
//} else {
//    $isLoggedIn = false;
//    header("Location: index.php");
//    exit();
//}

if (isset($_POST['content'])) {
    $content = $_POST['content'];

    // Lưu nội dung bình luận vào cơ sở dữ liệu
    saveComment($content, $username);
    header("Location: index.php");
    exit();
}
?>