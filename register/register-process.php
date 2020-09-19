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

            // Thay vì  hiển thị hồ sơ mặc định này, vì vậy ta chỉ muốn hiển thị ở đây đăng ký hồ sơ người dùng
            // tại đây vì vậy tôi sẽ chỉ lấy hồ sơ đó bằng Session ID

            // sesion này là cách lưu trữ thông tin, ví dụ như một biến để được sử dụng trên nhiều trang
            // nên ta sẽ tạo ở đây một biến SESSION để truy cập ID user

            // start a new  session,
            session_start();

            // create session variable
            // ở đây sẽ chỉ trả lại ID được chèn hiện tại của user và điều này sẽ chỉ lưu trữ ID của họ
            // vì vậy trong ngoặc đơn mysqli_insert_id là chỉ định tham số kết nối
            $_SESSION['userID'] = mysqli_insert_id($con);

            // Sau khi ta có ID của mình, ta cũng có thể truy nhập ID này trên tệp login.php, vì vậy bằng
            // cách sử dụng ID này,ta sẽ lấy thông tin của người dùng và hiển thị hồ sơ người dùng trên trang
            // login, ở đây sẽ tạo 1 function get_user_infos() trong helper.php để có được tất cả thông tin về người dùng mới

            header("Location: login.php");
            exit();
        }else{
            print "Error while registration...!";
        }
    }else{
        echo 'not validate';
    }
?>