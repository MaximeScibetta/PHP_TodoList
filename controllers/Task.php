<?php
namespace Controllers;

use Models\Task as TaskModel;

class Task
{
    private $tasksModel = null;

    public function __construct()
    {
        $this->tasksModel = new TaskModel();
    }

    public function listing()
    {
        $this->checkLogin();
        if ($_SESSION['task'] = $this->tasksModel->getTasks($_SESSION['user']->id)) {
            $view = 'views/indexTask.php';
        } else {
            $_SESSION['errors'] = [
                'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
            ];
            $view = 'views/indexTask.php';
        }
        return compact('view');
    }
    public function create()
    {
        $this->checkLogin();
        $description = $_POST['description'];
        if( isset($description) ){
            $this->tasksModel->createTask( $this->tasksModel->newTask($description) ,$_SESSION['user']->id );
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
            exit;
        }
    }
    public function postDelete()
    {
        $this->checkLogin();
        $taskId = $_POST['id'];
        $this->tasksModel->deleteTask($taskId);
        unset($_SESSION['task']);
        header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
        exit;
    }
    public function getUpdate()
    {
        $this->checkLogin();
        //$taskId = $_GET['id'];
        return ['view' => 'views/indexTask.php'];
    }

    public function postUpdate()
    {
        $this->checkLogin();
        if ( isset($_POST['is_done'])){
            $_POST['is_done'] = 1;
        }else{
            $_POST['is_done'] = 0;
        }
        isset($_POST['description']) ?: $_POST['description'] = null;

        $isDone = $_POST['is_done'];
        $description = $_POST['description'];
        $taskId = $_POST['id'];
        if(isset($description)||isset($isDone)||isset($taskId)){
            $this->tasksModel->modifyTask($description, $isDone, $taskId);
            header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
            exit;
        }
    }
}