<?php
    session_start();

    if(!isset($_SESSION["users"])){
        $_SESSION["users"] = [];
    } //setting up my initial array, so that i can put in keys and values in
    //Register user
    if($_SERVER["REQUEST_METHOD"] == "POST"){ //MUST ALWAYS USE THREE EQUALS
        $formType = $_POST["formType"];//allows me too differentiate between login and register forms

        if($formType == "register"){
            $username = $_POST["Rusername"] ?? ""; //if the program cant find the value, then just leave it blank
            $email = $_POST["Remail"] ?? "";
            $password = $_POST["Rpassword"] ?? ""; //not encrypting password YET    

            $user = [ //stores all gathered data in a user associative array
                "username"=> $username,
                "email"=> $email,
                "password"=> $password
            ];
            array_push($users, $user); //i put the user in the users array
            echo "<script>alert('User registered successfully!');</script>";
        }
        
    }

    if($_SERVER["REQUEST_METHOD"] = $_POST){

    }
?>