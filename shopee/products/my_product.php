<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style1/products.css" />
    <link rel="stylesheet" href="../style1/paging_products.css" />
    <title>My Item</title>
</head>

<body style="display: flex;
    flex-direction: column;
    min-height: 100vh;">
    <?php
    include_once ("header.php");
    ?>
    <div style="flex: 1;">
        <form id="searching_form" method="get">
            <div id="search-suggestions" class="search-suggestions"></div>
            <label>Number of items per page:</label>
            <select id="item_num" name="item_num" class="item_num">
                <option value="8" <?php if (isset($_GET['item_num']) && $_GET['item_num'] == 8)
                    echo 'selected'; ?>>8
                </option>
                <option value="12" <?php if (isset($_GET['item_num']) && $_GET['item_num'] == 12)
                    echo 'selected'; ?>>12
                </option>
                <option value="16" <?php if (isset($_GET['item_num']) && $_GET['item_num'] == 16)
                    echo 'selected'; ?>>16
                </option>
                <option value="20" <?php if (isset($_GET['item_num']) && $_GET['item_num'] == 20)
                    echo 'selected'; ?>>20
                </option>
            </select>
        </form>

        <main>
            <?php
            require "../database/connect.php";
            if (!isset($_SESSION["uid"])) {
                echo '<script>
                    alert("You need to log in to access this page.");
                    window.location.href = "../index.php?page=login";
                  </script>';
                exit();
            }
            $items_per_page = isset($_GET['item_num']) ? (int) $_GET['item_num'] : 8;
            $current_page = isset($_GET['pagee']) ? (int) $_GET['pagee'] : 1;
            $offset = ($current_page - 1) * $items_per_page;
            $uid = $_SESSION["uid"];

            $sql_count = "SELECT COUNT(*) as total FROM product_table WHERE uid = '$uid'";
            $result_count = mysqli_query($con, $sql_count);
            $row_count = mysqli_fetch_assoc($result_count);
            $total_items = $row_count['total'];

            $sql = "SELECT * FROM product_table WHERE uid = '$uid' LIMIT $items_per_page OFFSET $offset";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="page_display" >';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a  href="item_info.php?pid=' . $row["pid"] . '&item_num=' . $items_per_page . '&pagee=' . $current_page . '&uid=' . $uid . '"class="product_display">
                        <img src="' . $row['image'] . '"> <br>' .
                        "<p>Product's name:</p>" .
                        '<p>' . $row['pname'] . '</p><br>
                        <p>Price: ' . $row['Price'] . ' VND </p>
                    </a>';
                }
                echo '</div>';
                $total_pages = ceil($total_items / $items_per_page);
                $numberSet = [1, $current_page - 1, $current_page, $current_page + 1, $current_page - 2, $current_page + 2, $total_pages];
                $blank = false;
                $pre_num = 0;
                echo '<br>';
                echo '<div class="pagination">';
                for ($i = 1; $i <= $total_pages; $i++) {
                    if (in_array($i, $numberSet)) {
                        if ($blank === true) {
                            $blank = false;
                            $mid_num = floor(($pre_num + $i) / 2);
                            echo '<a href="?item_num=' . $items_per_page . '&pagee=' . $mid_num . '" class = "page_num">...' . $mid_num . '...</a>';
                            $pre_num = 0;
                        }
                        echo '<a href="?item_num=' . $items_per_page . '&pagee=' . $i . '"';
                        if ($current_page === $i)
                            echo 'class = "page_chosen"';
                        else
                            echo 'class = "page_num"';
                        echo '>' . $i . '</a>';
                    } else {
                        $blank = true;
                        if ($pre_num === 0)
                            $pre_num = $i;
                    }
                }
                echo '</div>';
            } else {
                echo "<p>No result found</p>";
            }
            ?>
    </div>
    <?php
    include_once ("footer.php");
    ?>
    <script src="../js/paging_products.js"></script>
    </main>
</body>

</html>