<?php 

    // define constant variables
    define ('DB_USER', 'root');
    define ('DB_PASSWORD', '');
    define ('DB_HOST', 'localhost');

    try{
        // connection variable
        $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

        // Create database
        $sql = "CREATE DATABASE register_db";
        if($con->query($sql) ===TRUE){
            echo "Database created successfully";
        }else{
            echo "Error creating database: ".$con->error;
        }
        $con->close();

    }catch(Exception $ex){
        print "An Exception occurred Message". $ex->getMessage();
    }catch(Error $e){
        print "The system is busy please try later";
    }
?>