<?php

namespace Models;

use Models\Model as ModelModel;

class Auth
{
    private $modelModel = null;

    public function __construct()
    {
        $this->modelModel = new ModelModel();
    }

    public function checkUser($email, $password)
    {
        $pdo = $this->modelModel->connectDB();
        if ($pdo) {
            $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
            try {
                $pdoSt = $pdo->prepare($sql);
                $pdoSt -> execute([
                    ':email' => $email,
                    ':password' => $password
                ]);
                return $pdoSt->fetch();
            }catch (PDOException $e) {
                return '';
            }
        } else {
            die('Quelque chose a posé problème lors de l’enregistrement');
        }
    }
}