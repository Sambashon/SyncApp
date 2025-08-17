<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styles.css">
</head>
<body>
    <header>
        <aside>
            <img src="assets/SyncAPp.svg" alt="SyncApp">
        </aside>
    </header>
    <div class="customDiv">
        <h1>
            Now, Login!
        </h1>
        <div class="formContainer">
            <form method="POST" action="../auth/DBManager.php">
                
                <input type="hidden" name="formType" value="login"> <!--Allows me to tell whether im registering or logging in-->

                <div class="mb-3 asd">
                    <label for="usernameLogin" class="form-label">Enter your username</label>
                    <input type="text" name="username" id="usernameLogin" required>
                </div>

                <div class="mb-3 asd">
                    <label for="passwordLogin" class="form-label">Enter your password</label>
                    <input type="password" name="password" id="passwordLogin" required>
                </div>

                <button type="submit" class="btn btn-primary" id="submit">Login</button>
            </form>
        </div>  
    </div>
    

    <?php
        include "../auth/DBManager.php";
    ?>
    <ul>
        <?php
            if (isset($_SESSION["userRegistered"])) {
                echo "<script>alert('User registered successfully!');</script>";
                unset($_SESSION["userRegistered"]); // remove flag so it doesn't show again
            }
    ?>
    </ul>
    
    <script src="../src/js/inputControl.js"></script>
</body>
</html>