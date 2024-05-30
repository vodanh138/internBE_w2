<?php
require "../database/connect.php";
$name = "test";
    $price = 300;
    $state = "Đà Nẵng";
    $city = "Đà Nẵng";
    $district = "Hải Châu";
    $id = 1;
    $image_path = "../asset/sơ yếu lý lịch 2.jpg";
$sql = "INSERT INTO product_table (pname, image, Price, State, City, District,uid) VALUES ('$name', '$image_path', $price, '$state', '$city', '$district','$id')";
for($i=1;$i<100;$i++){mysqli_query($con, $sql);}
?>