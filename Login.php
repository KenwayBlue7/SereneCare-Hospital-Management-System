<?php include 'includes/Header.php';

require './Config/login_config.php';

if (isset($_POST["nu-sign-up"])) {
    $ussr_su = new User();
    $ussr_su->register($conn);
}

if (isset($_POST["nu-sign-in"])) {
    $ussr_si = new User();
    $ussr_si->login($conn);
}
?>

    <link rel="stylesheet" href="css/Login.css">
</head>
<body>

    <div class="container" id="container">

        <div class="form-container sign-up">
            <form method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Create Account</h1>
                <input name = "nu-name" type="text" required placeholder="Name">
                <input name = "nu-email" type="email" required placeholder="Email">
                <input name = "nu-username" type="text" required placeholder="Username"> 
                <input name = "nu-password" type="password" required placeholder="Password">
                <!-- <button class = "sign-buttons" name = "nu-sign-up" type="submit">Sign Up</button> -->
                <button name = "nu-sign-up" type = "submit">Sign Up</button>

            </form>
        </div>

        <div class="form-container sign-in">
            <form method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Sign In</h1>
                <input name = "li-username" type="text" required placeholder="Username">
                <input name = "li-password" type="password" required placeholder="Password">
                <a href="#">Forgot Password?</a>
                <!-- <button class = "sign-buttons" name = "nu-sign-in" type="submit">Sign In</button> -->
                <button name = "nu-sign-in" type = "submit">Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Hello!</h1>
                    <p>Register with your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src = "includes/Login.js"></script>
</body>
</html>