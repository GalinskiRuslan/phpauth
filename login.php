<?php require('./bd.php');

$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'login=?', array($data['login']));
    if ($user) {
        //Пользователь найден в БД
        if (password_verify($data['password'], $user->password)) {
            // пороль совпадает
            $_SESSION['logged_user'] = $user;
            echo '<div class="errors">Вы вошли!<br>Можете вернуться на <a href="./index.php">Главную</a> страницу</div> <hr>';
        } else {
            $errors[] = 'Неверный пороль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден!';
    }

    if (empty($errors)) {
    } else {
        echo '<div class="errors" style="color:red;">' . array_shift($errors) . '</div> <hr>';
    }
}
?>

<form method="POST" action="./login.php">
    <p><label>Логин</label></p>
    <p> <input type="text" placeholder="login" name="login" value="<?php echo @$data['login']; ?>" /> </p>
    <p><label>пароль</label></p>
    <input type="password" placeholder="пароль" name="password" />
    <input type="submit" name="do_login" />
</form>