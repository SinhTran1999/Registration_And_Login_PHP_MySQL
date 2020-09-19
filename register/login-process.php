<?php 
    $error = array();

    $email = validate_input_text($_POST['email']);
    if(empty($email)){
        $error[] = "You forgot to enter your email";
    }

    $password = validate_input_text($_POST['password']);
    if(empty($password)){
        $error[] = "You forgot to enter your password";
    }

    if(empty($error)){
        // sql query
        $query = "SELECT userID, firstName, lastName, email, password, profileImage FROM user WHERE email = ?";
        
        // Chỉ khởi tạo câu lệnh này chỉ định tham số kết nối $con
        $q = mysqli_stmt_init($con);

        // Chuẩn bị đối tượng kết nối và đọc câu lệnh query
        mysqli_stmt_prepare($q, $query);
        
        // bind parameter
        mysqli_stmt_bind_param($q, 's', $email);

        // execute query
        mysqli_stmt_execute($q);

        // nhận kết quả từ execute query $q trong bảng MySQL
        $result = mysqli_stmt_get_result($q);

        // Tìm nạp sql vào  mảng kết hợp, kết quả là dạng một mảng kết hợp hoặc một mảng số, hoặc cả 2 tùy thuộc vào tham
        // số, ở đây là một mảng kết hợp có các cặp KEY->VALUE
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(!empty($row)){
            // verify password
            if(password_verify($password, $row['password'])){
                header("Location: index.php");
                exit();
            }
        }else{
            print "You are not a member please register!";
        }

    }else{
        echo "Please fill out email and password to login";
    }
?>