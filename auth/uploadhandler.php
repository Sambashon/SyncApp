<?php
    session_start();
    $filename = $_FILES["userfile"]["name"]; //in theory gets uploaded file https://www.youtube.com/watch?v=UWMyOleUbys&t=3s
    $filesize = $_FILES["userfile"]["size"]; #TODO: sanitize filenames so that they dont fuck me over

    $location = __DIR__."/../uploads/".$filename;
    
    $dbservername = "localhost"; //prepareing for connection
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "SyncApp";

    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname); //establishes connection
    $conn -> set_charset("utf8mb4");
    if($conn -> connect_error){ // checks for the error
        echo "Could not connect to DB";
    }

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
        $fileUploadStatement = $conn->prepare("INSERT INTO files(filename, size, user_id) VALUES (?,?,?) ");
        $fileUploadStatement->bind_param("sii", $filename, $filesize, $_SESSION["userID"] ); // i should check whether ind params failed
        $fileUploadStatement->execute();
        $fileUploadStatement->close();

        if (!$fileUploadStatement->execute()) {
            echo "File not registered in DB (" . $fileUploadStatement->errno . ") " . $fileUploadStatement->error;
        } else {
            echo "File registered in DB.";
        }
    }else{
        echo "upload failed"; 
    }
    
?>      