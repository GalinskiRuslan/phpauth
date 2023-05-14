<?php require('bd.php');
?>
<?php if (isset($_SESSION['logged_user'])) : ?>
    Авторизован!<br>
    Пользователь <?php echo $_SESSION['logged_user']->login; ?>
    <a href="logout.php">Выйти</a>
<?php else : ?>
    <a href="./registr.php">Регистрация</a><br>
    <a href="./login.php">Авторизация</a>
<?php endif; ?>