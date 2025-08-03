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
        
        include("Resources/DBManager.php");
        if (!isset($_SESSION["userLogged"]) || $_SESSION["userLogged"] !== true) {
            // Redirect to login if not logged in
            header("Location: auth/login.php");
            exit();
        }
    ?>

    <header>
        <aside>
            <img src="Resources/SyncAPp.svg" alt="SyncApp">
        </aside>
        <nav>
            <button>Logout</button>
        </nav>
    </header>
    <main>
        <h1>Upload your files</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="formType" value="upload">
            <label for="fileupload">Upload files..</label>
            <input type="file" name="fileupload" id="fileupload" placeholder="Select">
        </form>
        
    </main>
</body>
</html>