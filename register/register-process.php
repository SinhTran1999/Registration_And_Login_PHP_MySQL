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

    $files = $_FILES['profileUpload'];
    $profileImage = upload_profile('./assets/profile/',$files);

    if(empty($error)){
        // register a new user
        // Ở đây sử dụng phương pháp băm mật khẩu để băm mật khẩu cho người dùng
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        require('mysqli_connect.php');

        // make a query
        $query = "INSERT INTO user(userID, firstName, lastName, email, password, profileImage)";
        $query .= "VALUES('',?,?,?,?,?)";

        // Initialize a statement
        $q = mysqli_stmt_init($con);

        // prepare sql statement
        mysqli_stmt_prepare($q, $query);

        // bind values
        mysqli_stmt_bind_param($q, 'sssss', $firstName, $lastName, $email, $hashed_pass, $profileImage);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) == 1){
            header("Location: login.php");
            exit();
        }else{
            print "Error while registration...!";
        }
    }else{
        echo 'not validate';
    }
?>