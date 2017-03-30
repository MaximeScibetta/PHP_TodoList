<?php

namespace Models;

class Task
{
    public function getTasks($userId)
    {
        $pdo = connectDB();
        if ($pdo){
            $sql = 'SELECT tasks.id AS taskId, tasks.description AS taskDescription, tasks.is_done AS taskIsDone 
                FROM tasks
                LEFT JOIN task_user ON tasks.id = task_user.task_id
                LEFT JOIN users ON task_user.user_id = users.id
                WHERE users.id = :userId
                ORDER BY description';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt -> execute([
                    ':userId' => $userId,
                ]);
                return $pdoSt->fetchAll();
            }catch (PDOException $e) {
                return '';
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }
    public function newTask($description)
    {
        $pdo = connectDB();
        if($pdo){
            $sql = 'INSERT INTO tasks(`description`) VALUES(:description)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt -> execute([
                    ':description' => $description,
                ]);
                $lastId =  $pdo->lastInsertId();

                return $lastId;
            }catch (PDOException $e) {
                return '';
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }
    public function createTask($taskId, $userId)
    {
        $pdo = connectDB();
        if($pdo){
            $sql = 'INSERT INTO task_user(`task_id`, `user_id`) VALUES(:task_id, :user_id)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt ->execute([
                    ':task_id' => $taskId,
                    ':user_id' => $userId,
                ]);
            }catch (PDOException $e) {
                return '';
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }
    public function deleteTask($taskId)
    {
        $pdo = connectDB();
        if($pdo){
            $sql = 'DELETE FROM tasks WHERE id = :id';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt ->execute([
                    ':id' => $taskId,
                ]);
            }catch (PDOException $e) {
                return '';
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }

    public function modifyTask($description, $isDone, $taskId)
    {
        $pdo = connectDB();
        if($pdo){
            $sql="UPDATE tasks SET description=IFNULL(:description, description), is_done=:isDone WHERE id = :id";
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':id'=>$taskId,
                    ':description'=>$description,
                    ':isDone'=>$isDone,
                ]);
            }catch (PDOException $e) {
                die('Quelque chose a posé problème lors de l’enregistrement');
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }
}