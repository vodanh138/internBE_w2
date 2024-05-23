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
    $sql = "DELETE FROM product_table WHERE pid = '$pid'";
    $result = mysqli_query($con, $sql);
    header('Location: my_product.php');
    exit;
} else {
    echo "Invalid request.";
}
?>
