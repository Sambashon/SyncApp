<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

#Basically, think of it of when i define all the HTML parts i'll use in JS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SyncApp";

$conn = new mysqli($servername, $username, $password, $dbname); #establishes a connection
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die("Error connecting to DB" . $conn->connect_error);
}

#I'm just gonna use the logic i made for accManager.php
#Noticed a redundancy, I already differentiated whether user is trying to login or register.

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $formType = $_POST["formType"];
    if($formType == "register"){
        $username = trim($_POST["username"]); #Just defining the vars that recieve userinput
        $email = $_POST["email"] ? $_POST["email"] : null; #if no email is given, puts in null
        $password = $_POST["password"];
        $passHash = password_hash($password, PASSWORD_DEFAULT);

        if($email !== null && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("<script>alert('Invalid email!'); </script>");
        }
        
        if(strlen($username) < 3){
            die("<script>alert('User too short!'); </script>");
        }
        #TODO: I should make it so that it checks whether or not a user is already registered.
        #this is to avoid sqlInyections
        $checkNamestmnt = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
        $checkNamestmnt->bind_param("s", $username);
        $checkNamestmnt->execute();
        $checkNamestmnt->store_result(); #saves my query in a buffer

        if($checkNamestmnt->num_rows > 0){ #num_rows is a property of my query, and if it is over 0 then the user exists.
            die("<script>alert('User already exists');</script>");
        }

        $statement = $conn->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)"); #according to chatgpt, these are placeholders, and they're useful to avoid sqlinyections
        $statement->bind_param("sss", $username, $email, $passHash); #"sss" indicates that the following values are strings bind param puts those vars in the ???

        if ($statement->execute()) {
            echo "<script>alert('User register successfully!'); </script>";
        } else {
            echo "Failed to register: " . $statement->error;
        }
        $statement->close();
        

    }elseif($formType == "login"){
        $username = trim($_POST["username"]); #Just defining the vars that recieve userinput
        $password = $_POST["password"];
        
        if(strlen($username) < 3){
            die("<script>alert('User too short!'); </script>");
        }

        $statement = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();

        if($result->num_rows === 1){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row["password"])){
                $_SESSION["userLogged"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["userID"] = $row["username"];
                echo "<script>alert('Login successful'); window.location.href='../home.php';</script>";
            }else{
                echo "<script>alert('Incorrect password');</script>";
            }
        }else{
             echo "<script>alert('User not found');</script>";
        }
        $statement->close();
    }
}

?>