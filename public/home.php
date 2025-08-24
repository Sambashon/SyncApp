<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styles.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION["userLogged"]) || $_SESSION["userLogged"] !== true) {
            // Redirect to login if not logged in
            echo "<script>
            alert('User not logged in, log in please!');
            window.location.href = 'login.php';
            </script>";
            exit;
        }
    ?>

    <header>
        <aside>
            <img src="assets/SyncAPp.svg" alt="SyncApp">
        </aside>
        <?php
            echo "User: ".$_SESSION["username"];
        ?>
        <nav>
            <button>Logout</button>
        </nav>
    </header>
    <main>
        <h1>Upload your files</h1>
        <form method="POST" action="../auth/uploadhandler.php" enctype="multipart/form-data">
            <input type="hidden" name="formType" value="upload">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000"> <!--30MB-->
            <label for="fileupload">Upload files..</label>
            <br>    
            <input name="userfile" type="file">
            <input type="submit" value="Upload">
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!empty($_FILES)){
                print_r($_FILES);
                $_FILES["userfile"]["name"];
                $_FILES["userfile"]["size"];
            }else{
                echo "No file uploaded";
            }
        }
        var_dump($_SESSION); // everything works
        ?>
    </main>
</body>
</html>