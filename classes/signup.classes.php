<?php
class SignUp extends Dbh
{
    protected function setUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users (users_email, users_pwd) VALUES (?, ?);");

        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $hashedPassword))) {
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = NULL;
    }

    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare("SELECT users_email FROM users WHERE users_email = ?");

        if (!$stmt->execute(array($email))) {
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}