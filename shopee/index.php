<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="./style1/index.css" />
</head>

<body>

    <main>
        <?php
        include_once("user/header.php");
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $page_path = './user/' . $page . '.php';
        if (file_exists($page_path)) {
            include $page_path;
        } else {
            echo "404 Page not found";
        }
        ?>
    </main>

</body>

</html>