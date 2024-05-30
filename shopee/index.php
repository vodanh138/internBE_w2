<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="./style1/index.css" />
    <link rel="stylesheet" href="./style1/footer.css" />
</head>

<body style="display: flex;
    flex-direction: column;
    min-height: 100vh;">

    <main>
        <div style="flex: 1;">
            <?php
            include_once ("user/header.php");
            ?>

            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'login';
            $page_path = './user/' . $page . '.php';
            if (file_exists($page_path)) {
                include $page_path;
            } else {
                echo "404 Page not found";
            }
            ?>
        </div>
        <?php
        include_once ("user/footer.php");
        ?>
    </main>

</body>

</html>