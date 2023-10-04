<?php
session_start();
include_once "model.php";
// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['username'] = $username;
        $isLoggedIn = true;
    } else {
        $loginError = "Invalid username or password.";
    }
}

// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    $isLoggedIn = false;
    $username = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Comment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Simple Comment System</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Quản lý bình luận</a></li>
        <li><a href="admin1.php">Quản lý admin</a></li>
    </ul>
</nav>
<form action="" method="GET" class="search-form">
    <input type="text" name="search" placeholder="Search">
    <input type="submit" name="timkiem" value="Search">
</form>
<?php
if (isset($_GET['timkiem'])) {
    echo "Đây là".$_GET['search'];
}
?>
<?php
//if (isset($_GET['timkiem'])) {
//    $searchTerm = htmlspecialchars($_GET['search']);
//    echo "Đây là " . $searchTerm;
//}
//?>
<h2 style="text-align: center;">Login</h2>
<?php if ($isLoggedIn): ?>
    <p>Welcome, <?php echo $username; ?>!
    <form action="" method="POST" class="logout-form">
        <input type="submit" name="logout" value="Logout">
    </form>
    </p>
<?php else: ?>
    <form action="" method="POST" class="login-form">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
    </form>
    <?php if (isset($loginError)): ?>
        <p class="error-message"><?php echo $loginError; ?></p>
    <?php endif; ?>
<?php endif; ?>


<?php
// Lấy các bình luận từ cơ sở dữ liệu và hiển thị
if ($isLoggedIn) {
   echo " <h2>List Comments</h2>
        
 ";
    $comments = getComments();
    foreach ($comments as $comment) {
        echo "<div>" . $comment['content'] . "</div>";
    }
}
?>

<div class="centered-container">
    <h2>Add a Comment</h2>
    <form action="add_comment.php" method="POST">
        <textarea name="content" rows="6" cols="80" placeholder="Enter your comment"></textarea>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>