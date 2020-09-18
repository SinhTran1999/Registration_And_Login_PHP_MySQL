<?php 
    function validate_input_text($textValue){
        if(!empty($textValue)){
            $trim_text = trim($textValue);
            // remove illegal character
            $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
            return $sanitize_str;
        }      
        return '';
    }

    function validate_input_email($emailValue){
        if(!empty($emailValue)){
            $trim_text = trim($emailValue);
            // remove illegal character
            $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
            return $sanitize_str;
        }      
        return '';
    }


    // profile image
    function upload_profile($path, $filename){
        $targetDir =$path;
        $default = "beard.png";

        // get the filename
        $filename = basename($filename['name']);
        $targetFilePath = $targetDir.$filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if(!empty($filename)){
            // allow certain file format
            $allowType = array('jpg','png','jpeg', 'gif','pdf');
            if(in_array($fileType, $allowType)){
                // upload file to the server
                if(move_uploaded_file($filename['tmp_name'], $targetFilePath)){
                    return $targetFilePath;
                }
            }
        }
        // return default image
        return $path.$default;
    }
?>