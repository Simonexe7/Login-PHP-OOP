<?php

class LoginContr extends Login
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            header("location: ../index.php?=error=emptyInput");
            exit();
        }

        $this->getUser($this->email, $this->password);
    }

    private function emptyInput()
    {
        $result;
        if (empty ($this->email) || empty ($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}