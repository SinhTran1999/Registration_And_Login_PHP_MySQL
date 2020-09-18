<?php 

    // define constant variables
    define ('DB_NAME', 'register_db');
    define ('DB_USER', 'root');
    define ('DB_PASSWORD', '');
    define ('DB_HOST', 'localhost');

    try{
        // connection variable
        $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        // Sql to create table
        $sql = "CREATE TABLE user(
            userID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstName varchar(100) NOT NULL,
            lastName  varchar(100) NOT NULL,
            email varchar(200) NOT NULL,
            password varchar(200) NOT NULL,
            profileImage varchar(255),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if($con->query($sql) == TRUE){
            echo "Table register_db created successfully";
        }else{
            echo "Error creating table: " .$con->error;
        }
    }catch(Exception $ex){
        print "An Exception occurred Message". $ex->getMessage();
    }catch(Error $e){
        print "The system is busy please try later";
    }
?>