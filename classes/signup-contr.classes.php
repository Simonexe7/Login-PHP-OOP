<?php

class SignupContr extends SignUp
{
    private $email;
    private $password;
    private $pwdRepeat;

    public function __construct($email, $password, $pwdRepeat)
    {
        $this->email = $email;
        $this->password = $password;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function signupUser()
    {
        if ($this->emptyInput() == false) {
            header("location: ../index.php?=error=emptyInput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            header("location: ../index.php?=error=invalidEmail");
            exit();
        }
        if ($this->pwdMatch() == false) {
            header("location: ../index.php?=error=pwdMatch");
            exit();
        }
        if ($this->userTakenCheck() == false) {
            header("location: ../index.php?=error=userTakenCheck");
            exit();
        }

        $this->setUser($this->email, $this->password);
    }

    private function emptyInput()
    {
        $result;
        if (empty ($this->email) || empty ($this->password) || empty ($this->pwdRepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result;
        if ($this->password !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function userTakenCheck()
    {
        $result;
        if (!$this->checkUser($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}