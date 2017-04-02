<?php
namespace Controllers;

use Models\Task as TaskModel;

class Task extends Controller
{
    private $tasksModel = null;

    public function __construct()
    {
        $this->tasksModel = new TaskModel();
    }

    public function listing()
    {
        $this->checkLogin();
        if ($this->tasksModel->getTasks($_SESSION['user']->id)) {
            $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
            $errors = [];
            $view = 'views/indexTask.php';
        } else {
            $tasks = [];
            $errors = [
                'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
            ];
            $view = 'views/indexTask.php';
        }
        return compact('view', 'tasks', 'errors');
    }
    public function create()
    {
        $this->checkLogin();
        $description = $_POST['description'];
        if( isset($description) ){
            $this->tasksModel->createTask( $this->tasksModel->newTask($description) ,$_SESSION['user']->id );
            $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
            $view = 'views/indexTask.php';
            return compact('view', 'tasks');
        }
    }
    public function postDelete()
    {
        $this->checkLogin();
        $taskId = $_POST['id'];
        $this->tasksModel->deleteTask($taskId);
        $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
        if (empty($tasks)) {
            $errors = [
                'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
            ];
        }
        $view = 'views/indexTask.php';
        return compact('view', 'tasks', 'errors');
    }
    public function getUpdate()
    {
        $this->checkLogin();
        if (isset($_GET['id'])){
            $taskId = $_GET['id'];
        }
        $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
        $view = 'views/indexTask.php';
        return compact('view', 'tasks');
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
            $tasks = $this->tasksModel->getTasks($_SESSION['user']->id);
            $view = 'views/indexTask.php';
            return compact('view', 'tasks');
        }
    }
}