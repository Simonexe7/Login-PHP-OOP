<?php
class Login extends Dbh
{
    protected function getUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT users_pwd FROM users WHERE users_email = ?");

        if (!$stmt->execute(array($email))) {
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($pwdHashed) == 0) {
            $stmt = NULL;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        
        if ($checkPwd == false) {
            $stmt = NULL;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email = ? AND users_pwd = ?;');

            if (!$stmt->execute(array($email, $pwdHashed[0]["users_pwd"]))) {
                $stmt = NULL;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if (count($pwdHashed) == 0) {
                $stmt = NULL;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useremail"] = $user[0]["users_email"];

            $stmt = NULL;
        }

        $stmt = NULL;
    }
}