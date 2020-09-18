<?php 
    
    require('helper.php');
    // error variable
    $error = array();

    $firstName = validate_input_text($_POST['firstName']);
    if(empty($firstName)){
        $error[] = "You forgot to enter your first Name";
    }

    $lastName = validate_input_text($_POST['lastName']);
    if(empty($lastName)){
        $error[] = "You forgot to enter your last Name";
    }

    $email = validate_input_text($_POST['email']);
    if(empty($email)){
        $error[] = "You forgot to enter your email";
    }

    $password = validate_input_text($_POST['password']);
    if(empty($password)){
        $error[] = "You forgot to enter your password";
    }

    $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
    if(empty($confirm_pwd)){
        $error[] = "You forgot to enter your confirm password";
    }

    if(empty($error)){
        echo 'validate';
    }else{
        echo 'not validate';
    }
?>