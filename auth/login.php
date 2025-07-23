<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <aside>
            <img src="../Resources/SyncAPp.svg" alt="SyncApp">
        </aside>
        <section>
            <button>Close session</button>
        </section>
    </header>
    <div class="customDiv">
        <h1>
            Now, Login!
        </h1>
        <div class="formContainer">
            <form method="POST">
                
                <input type="hidden" name="formType" value="login"> <!--Allows me to tell whether im registering or logging in-->

                <div class="mb-3 asd">
                    <label for="usernameLogin" class="form-label">Enter your username</label>
                    <input type="text" name="Luser" id="usernameLogin" required>
                </div>

                <div class="mb-3 asd">
                    <label for="emaillogin" class="form-label">Enter your email</label>
                    <input type="email" name="Lemail" id="emailLogin">
                </div>

                <div class="mb-3 asd">
                    <label for="passwordLogin" class="form-label">Enter your password</label>
                    <input type="password" name="Lpassword" id="passwordLogin" required>
                </div>

                <button type="submit" class="btn btn-primary" id="submit">Login</button>
            </form>
        </div>  
    </div>
    

    <?php
        include "accManager.php";
    ?>
    <ul>
        <?php
            if (isset($_SESSION["userRegistered"])) {
                echo "<script>alert('User registered successfully!');</script>";
                unset($_SESSION["userRegistered"]); // remove flag so it doesn't show again
            }


            foreach ($_SESSION["users"] as $user) { //prints out all my users for debugging
                echo $user["username"];
            }
    ?>
    </ul>
    
    <script src="inputControl.js"></script>
</body>
</html>