<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "Админ-панель";
        }
        ?>
    </title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Admin</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Main <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Upload Question and Answer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-a.php">Add Question and Answer</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<hr>