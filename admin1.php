<nav>
    <ul>
        <li><a href="index.php">Quản lý bình luận</a></li>
        <li><a href="admin1.php">Quản lý admin</a></li>
    </ul>
</nav>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
echo "Đây là trang admin 1";
?>
<form action="index.php" method="POST" class="logout-form"><input type="submit" name="logout" value="Logout"></form>

