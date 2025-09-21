<?php
    if (isset($_POST["Login"])) {
        echo $_POST['Admin_Username']. '<br>';
        echo $_POST['Admin_Password']. '<br><br>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>
<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <label for="Admin_Username">Username: </label>
                <input type="text", name = "Admin_Username" placeholder="Admin Username">
            </div>
            <br>
            <div>
                <label for="Admin_Password">Password: </label>
                <input type="text", name = "Admin_Password" placeholder="Admin Password">
            </div>
            <br>
            <input type="submit" value="Login" name = "Login">
        </form>
    </div>
</body>
</html>