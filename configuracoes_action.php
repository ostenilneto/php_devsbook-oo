<?php
require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$userDao = new UserDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$birthdate = filter_input(INPUT_POST, 'birthdate');
$city = filter_input(INPUT_POST, 'city');
$work = filter_input(INPUT_POST, 'work');
$password = filter_input(INPUT_POST, 'password');
$password_confirmation = filter_input(INPUT_POST, 'password_confirmation');

if($name && $email /*&& $password && $birthdate*/) {
    $userInfo->name = $name;
    $userInfo->city = $city;
    $userInfo->work = $work;

    if($userInfo->email != $email) {
        if($userDao->findByEmail($email) === false) {
            
        } else {
            $_SESSION['flash'] = 'E-mail já existe!';
        }

        //$userInfo->email = $email;
    }

    //$userDao->update($userInfo);
}

header("Location: ".$base."/configuracoes.php");
exit;