<?php
include_once ("header.php");
require "../database/connect.php";
if(!isset($_SESSION["uid"])) {
    echo '<script>
            alert("You need to log in to access this page.");
            window.location.href = "../index.php?page=login";
          </script>';
    exit();
}
if (isset($_POST["add_name"]) && isset($_POST["add_price"]) && isset($_POST["State"]) && isset($_POST["City"]) && isset($_POST["District"])) {
    $target_directory = "../asset/";
    $target_file = $target_directory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $name = $_POST["add_name"];
    $price = $_POST["add_price"];
    $state = $_POST["State"];
    $city = $_POST["City"];
    $district = $_POST["District"];
    $id = $_SESSION["uid"];

    // Kiểm tra xem tệp có phải là hình ảnh hay không
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Kiểm tra kích thước tệp ảnh
        if ($_FILES["image"]["size"] > 5000000) {
            $error = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var miss_info = document.getElementById('miss_info');
                if (miss_info) {
                    miss_info.innerHTML = 'Sorry, your file is too large.';
                    miss_info.style.color = 'red';
                }
            });
            </script>";
        } else {
            // Di chuyển tệp ảnh vào thư mục "asset" trên máy chủ
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Lưu đường dẫn đến ảnh vào cơ sở dữ liệu
                $image_path = $target_file;
                $sql = "INSERT INTO product_table (pname, image, Price, State, City, District,uid) VALUES ('$name', '$image_path', $price, '$state', '$city', '$district','$id')";
                if (mysqli_query($con, $sql)) {
                    $error = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var miss_info = document.getElementById('miss_info');
                if (miss_info) {
                    miss_info.innerHTML = 'The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.';
                    miss_info.style.color = 'green';
                }
            });
            </script>";
                } else {
                    $error = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var miss_info = document.getElementById('miss_info');
                if (miss_info) {
                    miss_info.innerHTML = 'Error: " . $sql . "<br>" . mysqli_error($con) . "';
                    miss_info.style.color = 'red';
                }
            });
            </script>";

                }
            } else {
                $error = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var miss_info = document.getElementById('miss_info');
                if (miss_info) {
                    miss_info.innerHTML = 'Sorry, there was an error uploading your file.';
                    miss_info.style.color = 'red';
                }
            });
            </script>";
            }
        }
    } else {
        $error = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var miss_info = document.getElementById('miss_info');
                if (miss_info) {
                    miss_info.innerHTML = 'File is not an image..';
                    miss_info.style.color = 'red';
                }
            });
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
</head>

<body>
    <form method="post" id="add_form" enctype="multipart/form-data">
        <label class="p_name">Product's Name:</label>
        <input type="text" name="add_name" class="add_name" id="add_name"><br>
        <label class="p_name">Product's Price:</label>
        <input type="number" name="add_price" class="add_price" id="add_price">(VND)<br>

        <label for="State">State:</label>
        <select id="State" name="State">
            <option value="">Select State</option>
            <option value="Hà Nội">Hà Nội</option>
            <option value="Đà Nẵng">Đà Nẵng</option>
            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
        </select>

        <label for="City">City:</label>
        <select id="City" name="City">
            <option value="">Select City</option>
        </select>

        <label for="District">District:</label>
        <select id="District" name="District">
            <option value="">Select District</option>
        </select>
        <br>
        <input type="file" name="image" accept="image/*" id="add_file"><br>
        <button type="submit" name="btn_add" class="btn_add"> Add</button>
    </form>
    <div id="miss_info" class="miss_info" style="color:red;"></div>
    <?php
    if (isset($error))
        echo $error;
    ?>

    <script src="../js/add_products.js"></script>
</body>

</html>