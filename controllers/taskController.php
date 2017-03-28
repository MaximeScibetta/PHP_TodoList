<?php
//if( !$_SESSION['task'] ){
//    echo 'Vous n`avez pas encore de tâches. ';
//}elseif ( !isset($_SESSION['task']) ) {
//    $view = 'views/indexTask.php';
//}
function listing()
{
    include 'models/taskModel.php';
    if (getTasks($_SESSION['user']->id)) {
        $_SESSION['task'] = getTasks($_SESSION['user']->id);
        $view = 'views/indexTask.php';
    } elseif (!getTasks($_SESSION['user']->id)){
        $_SESSION['errors'] = [
            'task' => 'Il semblerait que vous n`ayez pas encore de tâche.',
        ];
        $view = 'views/indexTask.php';
    }
    return compact('view');
}
function create()
{
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
    $taskId = $_POST['id'];
    include 'models/taskModel.php';
    deleteTask($taskId);
    unset($_SESSION['task']);
    header('Location: http://homestead.app'.$_SERVER['PHP_SELF'].'?a=listing&r=task');
    exit;
}
function getUpdate()
{
    return ['view' => 'views/indexTask.php'];
}

function postUpdate()
{
    if ( isset($_POST['is_done'])){
        $_POST['is_done'] = 1;
    }else{
        $_POST['is_done'] = 0; // faut mettre la valeur actuelle
    }
    if(!isset($_POST['description'])) {
        $_POST['description'] = null;
    }
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