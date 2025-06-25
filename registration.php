<?php
require_once('db.php');

if (isset($_COOKIE['User'])) {
    header("Location: welcome.php");
    exit();
}

$message = '';

if (isset($_POST['submit'])) {
    $link = mysqli_connect('db', 'root', '1', 'first');
    if (!$link) { die("Ошибка подключения: " . mysqli_connect_error()); }

    $username = $_POST['login'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!$email || !$username || !$pass) {
        $message = 'Пожалуйста, заполните все поля!';
    } else {
        $sql = "INSERT INTO users (username, email, pass) VALUES ('$username', '$email', '$pass')";
        if (mysqli_query($link, $sql)) {
            $message = "Регистрация прошла успешно! Теперь вы можете <a href='index.php' style='color:#000; font-weight:bold;'>войти</a>.";
        } else {
            $message = "Ошибка регистрации: " . mysqli_error($link);
        }
    }
    mysqli_close($link);
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-wrapper">
    <h1>Регистрация</h1>

    <?php if ($message) echo "<div class='message-box'>$message</div>"; ?>

    <form method="POST" action="registration.php">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
        
        <label for="login">Логин</label>
        <input id="login" type="text" name="login" required>
        
        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" required>
        
        <button type="submit" name="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="index.php">Войти</a></p>
</div>

</body>
</html>