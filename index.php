<?php
require_once('db.php');

if (isset($_COOKIE['User'])) {
    header('Location: welcome.php');
    exit();
}

$error_message = '';

if (isset($_POST['submit'])) {
    $link = mysqli_connect('db', 'root', '1', 'first');
    if (!$link) { die("Ошибка подключения: " . mysqli_connect_error()); }

    $username = $_POST['login'];
    $pass = $_POST['password'];

    if (!$username || !$pass) {
        $error_message = 'Пожалуйста, введите логин и пароль!';
    } else {
        $sql = "SELECT * FROM users WHERE username='$username' AND pass='$pass'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            setcookie("User", $row['username'], time() + 7200, "/");
            header('Location: welcome.php');
            exit();
        } else {
            $error_message = "Неправильное имя пользователя или пароль";
        }
    }
    mysqli_close($link);
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-wrapper">
    <h1>Авторизация</h1>
    
    <?php if ($error_message) echo "<div class='message-box'>$error_message</div>"; ?>

    <form method="POST" action="index.php">
        <label for="login">Логин</label>
        <input id="login" type="text" name="login" required>
        
        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" required>
        
        <button type="submit" name="submit">Войти</button>
    </form>

    <p>Нет аккаунта? <a href="registration.php">Зарегистрироваться</a></p>
</div>

</body>
</html>