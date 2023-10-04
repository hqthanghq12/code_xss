<?php
function connectDB() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "xss";

    // Tạo kết nối đến cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function getComments() {
    $conn = connectDB();

    // Chuẩn bị câu lệnh SQL để lấy danh sách bình luận
    $sql = "SELECT * FROM comments ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $comments = array();

    // Kiểm tra và xử lý kết quả truy vấn
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    // Đóng kết nối
    $result->close();
    $conn->close();

    return $comments;
}

function saveComment($content, $username) {
    $conn = connectDB();

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng comments
    $sql = "INSERT INTO comments (content, username) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $content, $username);

    // Thực thi câu lệnh
    if ($stmt->execute() === TRUE) {
        echo "Comment saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>