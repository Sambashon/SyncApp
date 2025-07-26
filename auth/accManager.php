<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();

    if(!isset($_SESSION["users"])){
        $_SESSION["users"] = [];
    } //setting up my initial array, so that i can put in keys and values in
    //Register user
    if($_SERVER["REQUEST_METHOD"] == "POST"){ //MUST ALWAYS USE THREE EQUALS
        $formType = $_POST["formType"];//allows me too differentiate between login and register forms

        if($formType == "register"){
            $username = $_POST["Ruser"] ?? ""; //if the program cant find the value, then just leave it blank
            $email = $_POST["Remail"] ?? "";
            $password = $_POST["Rpassword"] ?? ""; //not encrypting password YET    

            $user = [ //stores all gathered data in a user associative array
                "username"=> $username,
                "email"=> $email,
                "password"=> $password
            ];
            array_push($_SESSION["users"], $user); //i put the user in the users array 
            $_SESSION["userRegistered"] = true;// just tells the server that register is set so i can show an alert since i cant put echoes after header
            header("Location: login.php"); //header redirects users to other pages, must immeadiately use exit after header
            exit;
            
        }elseif($formType == "login"){
            $username = $_POST["Luser"] ?? "";
            $email = $_POST["Lemail"] ?? "";
            $password = $_POST["Lpassword"] ?? "";
            
            $found = false;
            foreach($_SESSION["users"] as $user){
                if($user["username"] == $username){
                    $found = true;
                    if($user["password"] == $password){
                        $_SESSION["userLogged"] = true;
                        header("Location: ../home.php");
                        exit;
                    }else{
                        echo "<script>alert('Incorrect password')</script>";
                    }
                }
            }
            if(!$found){
                echo "<script>alert('User does not exist')</script>";
            }
        }
    }
?>