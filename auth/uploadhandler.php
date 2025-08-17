<?php
    session_start();
    $filename = $_FILES["userfile"]["name"]; //in theory gets uploaded file https://www.youtube.com/watch?v=UWMyOleUbys&t=3s
    $location = __DIR__."/../uploads/".$filename;
    
    
    if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) {
        echo "Temp file exists!";
    } else {
        echo "Temp file missing!";
    }
    
    $uploadDir = "/opt/lampp/htdocs/SyncApp/uploads";
    if (!is_dir($uploadDir)) {
        echo "Uploads folder does not exist.";
    } elseif (!is_writable($uploadDir)) {
        echo "Uploads folder is not writable.";
    } else {
        echo "Uploads folder exists and is writable.";
    }

    if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $location)){
        echo "Upload Successful";
        
    }else{
        echo "upload failed"; 
    }

?>      