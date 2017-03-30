<?php
namespace Controllers;

use Models\Auth as AuthModel;

class Auth extends Controller
{
    private $authModel = null;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function getLogin()
    {
        if( isset($_SESSION['user'])){
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
        }
        return ['view' => 'views/userLogin.php'];
    }
    public function postLogin()
    {
        $_SESSION['errors'] = [];
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = $_POST['email'];
        }else{
            $_SESSION['errors'] = [
                'email' => $_POST['email'] . ' semble ne pas être un email valide.',
            ];
            return ['view' => 'views/userLogin.php'];
        }
        $password = sha1($_POST['password']);
        if( $user = $this->authModel->checkUser($email, $password) ){
            $_SESSION['user'] = $user;
            $_SESSION['errors'] = [];
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
            exit;
        } else{
            $_SESSION['errors'] = [
                'password' => 'il semble que vous vous êtes trompé dans votre mot de passe.',
            ];
            return ['view' => 'views/userLogin.php'];
        }
    }
    public function getLogout()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location:http://homestead.app'.$_SERVER['PHP_SELF']);
        exit;
    }
}