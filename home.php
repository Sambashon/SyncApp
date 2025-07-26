<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="auth/styles.css">
</head>
<body>
    <?php
        include("auth/accManager.php");
        if (!isset($_SESSION["userLogged"]) || $_SESSION["userLogged"] !== true) {
        // Redirect to login if not logged in
        header("Location: login.php");
        exit;
    }       
    ?>

    <header>
        <aside>
            <img src="Resources/SyncAPp.svg" alt="SyncApp">
        </aside>
    </header>
    <main>
        <input type="file" name="fileupload" placeholder="Upload-Files">
    </main>
</body>
</html>