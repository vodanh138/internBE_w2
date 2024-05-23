<?php
include_once ("header.php");
if(!(isset($_SESSION["uid"]) == $_GET['uid'])) {
    echo '<script>
            alert("You need to log in to access this page.");
            window.location.href = "../index.php?page=login";
          </script>';
    exit();
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    require "../database/connect.php";
    // Chuẩn bị câu truy vấn xóa
    $sql = "DELETE FROM product_table WHERE pid = ?";
    
    // Sử dụng prepared statement để ngăn ngừa SQL injection
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $pid);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $con->error;
    }

    // Đóng kết nối
    $stmt->close();
    $con->close();

    // Chuyển hướng về trang trước hoặc trang bạn muốn
    header('Location: my_product.php');
    exit;
} else {
    echo "Invalid request.";
}
?>
