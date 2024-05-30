<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style1/paging_products.css" />
    <link rel="stylesheet" href="../style1/products.css" />
    <link rel="stylesheet" href="../style1/item_info.css" />
    <title>Item Details</title>
</head>

<body>
    <?php
    include_once ("header.php");
    require "../database/connect.php";

    if (isset($_GET["pid"])) {
        $items_per_page = isset($_GET['item_num']) ? (int) $_GET['item_num'] : 8;
        $current_page = isset($_GET['pagee']) ? (int) $_GET['pagee'] : 1;
        if (isset($_GET["uid"])) {
            echo '<a class="my-item-link" href="my_product.php?item_num=' . $items_per_page . '&pagee=' . $current_page . '"><span>&larr;</span>My Item</a>';
        } else {
            $search = isset($_GET['search_bar']) ? $_GET["search_bar"] : "";
            echo '<a class="my-item-link" href="paging_products.php?search_bar=' . $search . '&item_num=' . $items_per_page . '&pagee=' . $current_page . '"><span>&larr;</span>Search Item</a>';
        }

        $pid = $_GET["pid"];
        $sql = "SELECT * 
                FROM product_table 
                JOIN user_table ON product_table.uid = user_table.uid
                WHERE product_table.pid = '$pid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$row)
        echo '<script>
                alert("Item not found.");
                window.location.href = "../index.php";
            </script>';

        $view_inc = "UPDATE product_table SET view = view + 1 WHERE pid = '$pid'";
        mysqli_query($con, $view_inc);
        echo '<div class="product_display">
                        <img src="' . $row['image'] . '"> <br>' .
            "<p>Product's name:</p>" .
            '<p>' . $row['pname'] . '</p><br>
                        <p>Price: ' . $row['Price'] . '$ </p><br>
                        <p>Location: ' . $row['State'] . ', ';

        if (!($row['State'] === $row['City']))
            echo $row['City'] . ', ';
        echo $row['District'] . '</p><br>
            <p>User:  ' . $row['ori_username'] . '</p><br>
            </div>';
        if (isset($_GET["uid"])) {
            if (!isset($_SESSION["uid"]) || !($_SESSION["uid"] == $row['uid'])) {
                echo '<script>
                        alert("You need to log in to access this page.");
                        window.location.href = "../index.php?page=login";
                      </script>';
                exit();
            } else if ($_GET["uid"] === $_SESSION["uid"]) {
                $uid = $_SESSION["uid"];
                echo '<button class="edit-btn" onclick="edititem(' . $pid . ',' . $uid . ')">Edit</button>';
                echo '<button class="delete-btn" onclick="deleteitem(' . $pid . ',' . $uid . ')">Delete</button>';
            }
        }
    }
    ?>

    <script>
        function edititem(pid, uid) {
            window.location.href = 'edit.php?pid=' + pid + '&uid=' + uid;
        }

        function deleteitem(pid, uid) {
            if (confirm('Are you sure you want to delete this item?')) {
                window.location.href = 'delete.php?pid=' + pid + '&uid=' + uid;
            }
        }
    </script>
</body>

</html>