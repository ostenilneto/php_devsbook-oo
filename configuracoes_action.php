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

if($name && $email) {
    $userInfo->name = $name;
    $userInfo->city = $city;
    $userInfo->work = $work;

    // E-MAIL
    if($userInfo->email != $email) {
        if($userDao->findByEmail($email) === false) {
            $userInfo->email = $email;
        } else {
            $_SESSION['flash'] = 'E-mail já existe!';
            header("Location: ".$base."/configuracoes.php");
            exit;
        }        
    }

    // validação de data de nascimento //BIRTHDATE
    $birthdate = explode('/', $birthdate);
    if(count($birthdate) != 3) {
        $_SESSION['flash'] = 'Data de nascimento inválida.';
        header("Location: ".$base."/configuracoes.php");
        exit;
    }
    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
    if(strtotime($birthdate) === false) {
        $_SESSION['flash'] = 'Data de nascimento inválida.';
        header("Location: ".$base."/configuracoes.php");
        exit;
    }
    $userInfo->birthdate = $birthdate;

    //PASSWORD
    if(!empty($password)) {
        if($password === $password_confirmation) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userInfo->password = $hash;
        } else {
            $_SESSION['flash'] = 'As senhas não batem';
            header("Location: ".$base."/configuracoes.php");
            exit;
        }
    }

    // AVATAR
    if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
        $newAvatar = $_FILES['avatar'];

        if(in_array($newAvatar['type'], ['image/jpeg','image/jpg','image/png'])) {
            $avatarWidth = 200;
            $avatarHeight = 200;

            list($widthOrig. $heightOrig) = getimagesize($newAvatar['tmp_name']);
            $ratio = $widthOrig / $heightOrig;
            $newWidht = $avatarWidth;
            $newHeight = $newWidht / $ratio;

            if($newHeight < $avatarHeight) {
                $newHeight = $avatarHeight;
                $newWidht = $newHeight * $ratio;
            }
        }
    }
    exit;
    $userDao->update($userInfo);
}

header("Location: ".$base."/configuracoes.php");
exit;