<?php
if (!isset($_COOKIE['User'])) {
    header('Location: index.php');
    exit();
}

$username = $_COOKIE['User'];
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Приветствие</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcome-page">

    <h1>Привет, <?php echo $username; ?>!</h1>
    <p>Вы успешно авторизовались.</p>
    <a href="logout.php">Выйти</a>

</body>
</html>