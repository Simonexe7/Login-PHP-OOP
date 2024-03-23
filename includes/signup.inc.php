<?php

if (isset($_POST['submit'])) {
    // grabbing the data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pwdRepeat = $_POST['pwdRepeat'];

    // instantiate SignContr Class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($email, $password, $pwdRepeat);

    // Running error handlers and user signup
    $signup->signupUser();

    // going back to front page
    header("location: ../index.php?error=none");
}