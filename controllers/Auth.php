<?php
namespace Controllers;

use Models\Auth as AuthModel;
use Models\Task as TaskModel;

class Auth extends Controller
{
    private $authModel = null;
    private $tasksModel = null;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->tasksModel = new TaskModel();
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
        $errors = [];
        $password = sha1($_POST['password']);
        $email = $_POST['email'];
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $this->authModel->checkUser($email, $password)){
            $user = $this->authModel->checkUser($email, $password);
            $_SESSION['user'] = $user;
            if (empty($tasks)) {
                $errors = [
                    'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
                ];
                $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
            }
            $view = 'views/indexTask.php';
        }else{
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors = [
                    'email' => $_POST['email'] . ' semble ne pas être un email valide.',
                ];
            } else{
                $errors = [
                    'password' => 'Il semblerait que vous vous êtes trompez de mot de passe.',
                ];
            }

            $view = 'views/userLogin.php';
        }
        return compact('view', 'tasks', 'errors');
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