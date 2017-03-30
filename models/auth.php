<?php

namespace Models;

class Auth
{
    public function checkUser($email, $password)
    {
        $pdo = connectDB();
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