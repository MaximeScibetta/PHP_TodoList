<?php
function checkLogin()
{
    if( !isset($_SESSION['user'])) {
        header('Location: http://homestead.app' . $_SERVER['PHP_SELF']);
        exit;
    }
}
function listing()
{
    checkLogin();
    include 'models/taskModel.php';
    if ($_SESSION['task'] = getTasks($_SESSION['user']->id)) {
        $view = 'views/indexTask.php';
    } else {
        $_SESSION['errors'] = [
            'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
        ];
        $view = 'views/indexTask.php';
    }
    return compact('view');
}
function create()
{
    checkLogin();
    $description = $_POST['description'];
    include 'models/taskModel.php';
    if( isset($description) ){
        createTask( newTask($description) ,$_SESSION['user']->id );
        header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
        exit;
    }
}
function postDelete()
{
    checkLogin();
    $taskId = $_POST['id'];
    include 'models/taskModel.php';
    deleteTask($taskId);
    unset($_SESSION['task']);
    header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
    exit;
}
function getUpdate()
{
    checkLogin();
    //$taskId = $_GET['id'];
    return ['view' => 'views/indexTask.php'];
}

function postUpdate()
{
    checkLogin();
    if ( isset($_POST['is_done'])){
        $_POST['is_done'] = 1;
    }else{
        $_POST['is_done'] = 0;
    }
    isset($_POST['description']) ?: $_POST['description'] = null;

    $isDone = $_POST['is_done'];
    $description = $_POST['description'];
    $taskId = $_POST['id'];
    include 'models/taskModel.php';
    if(isset($description)||isset($isDone)||isset($taskId)){
        modifyTask($description, $isDone, $taskId);
        header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
        exit;
    }
}