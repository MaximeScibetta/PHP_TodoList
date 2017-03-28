<?php
function getLogin()
{
    return ['view' => 'views/userLogin.php'];
}
function postLogin()
{
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $_SESSION['errors'] = [];
    include 'models/authModel.php';
    if( $user = checkUser($email, $password) ){
        $_SESSION['user'] = $user;
        $_SESSION['errors'] = [];
        header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
        exit;
    } else{
        $_SESSION['errors'] = [
            'email' => $_POST['email'] . ' semble ne pas être un email valide.',
        ];
        return ['view' => 'views/userLogin.php'];
    }
}
function getLogout()
{
    return ['view' => 'views/userLogin.php'];
}