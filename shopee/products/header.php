<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style1/index.css" />
    <title>Document</title>
</head>

<body>
<div class="logo-con">
        <a href="../index.php?page=home">
            <div class="logo-container">
                <img src="../asset/hcmut.png">
            </div>
        </a>
        <div class="link">
            <p>
                Welcome to MyBK
            </p>
            <?php
            session_start();
            if (isset($_SESSION['ori_username'])) {
                $username = $_SESSION['ori_username'];
                echo '<div class="user_info">
                            <a href="../index.php?page=logout">
                                <img src="../asset/user.png">';
                echo "$username";
                echo '</a>
                        </div>';
            } else {
                echo '  <div class="login">
                            <a href="../index.php?page=login">Login</a>
                        </div>
                        <a href="../index.php?page=register">Register</a>
                        <a href="paging_products.php">Products</a>';
            }
            ?>
            <a href="../index.php?page=home">Home</a>
        </div>
    </div>
    <?php
    if (isset($_SESSION["ori_username"])) {
        echo '<div class="product">'.
                // <div class = "sproduct">
                //     <a href="products.php">Search Product Lazy</a>
                // </div>
                '<div class = "sproduct">
                    <a href="paging_products.php">Search Item</a>
                </div>
                <div class = "aproduct">
                    <a href="add_product.php">Add Item</a>
                </div>
                <div class = "mproduct">
                    <a href="my_product.php">My Item</a>
                </div>
            </div>';
    }
    ?>
</body>

</html>