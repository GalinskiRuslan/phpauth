<?php require('./bd.php');

$data = $_POST;
if (isset($data['do_registr'])) {
    $errors = array();
    if (trim($data['login'] == '')) {
        $errors[] = 'Введите логин';
    }
    if (trim($data['email'] == '')) {
        $errors[] = 'Введите email';
    }
    if ($data['password'] == '') {
        $errors[] = 'Введите пороль';
    }
    if ($data['password2'] != $data['password']) {
        $errors[] = 'Пороли не совпадают!';
    }
    if (R::count('users', 'login=? ', array($data['login'])) > 0) {
        $errors[] = 'Пользователь с таким логином уже существет';
    }
    if (R::count('users', 'email=?', array($data['email'])) > 0) {
        $errors[] = 'Пользователь с таким email уже существет';
    }
    if (empty($errors)) {
        // Проверки пройдены, регистрируем
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div class="errors">Вы зарегистрированы!</div> <hr>';
    } else {
        echo '<div class="errors" style="color:red;">' . array_shift($errors) . '</div> <hr>';
    }
}
?>

<form method="POST" action="./registr.php">
    <p><label>Ваш логин</label></p>
    <p> <input type="text" placeholder="login" name="login" value="<?php echo @$data['login']; ?>" /> </p>
    <p><label>Ваша почта</label></p>
    <p><input type="email" placeholder="Почта" name="email" value="<?php echo @$data['email']; ?>" /></p>
    <p><label>Ваш пароль</label></p>
    <input type="password" placeholder="пароль" name="password" />
    <p><label>повторите Ваш пароль</label></p>
    <p><input type="password" placeholder="Повторите пороль" name="password2" /></p>
    <input type="submit" name="do_registr" />
</form>