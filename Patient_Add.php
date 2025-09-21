<?php 
    include 'includes/Header.php';

    if(isset($_POST["save-patient"])) {
        $pat = new Patient();
        $pat->AddToDB($conn);
    }
?>

    <link rel="stylesheet" href="css/Patient_Add.css">
    </head>

<body>
    <aside>
        <a href="./Dashboard.php" id="dashborad-link">
            <div class="logo-title">
                <img src="./images/SereneCare-logo-white-50.png" alt="SereneCare">
                <h2>SereneCare</h2>
                <!-- <a href="./Index.php"><input class = "login-button" type="button" href value="Logout"></a> -->
            </div>
        </a>
        <ul>
        <a href="./Billings.php"><input class = "nav-buttons" id="billings" type="button" value="Billings"></a>
            <a href="./Patient_View.php"><input class = "nav-buttons" id="patient-view" type="button" value="Patients"></a>
            <a href="./Doctors.php"><input class = "nav-buttons" id="doctors" type="button" value="Doctors"></a>
            <a href="./Employees.php"><input class = "nav-buttons" id="employees" type="button" value="Employees"></a>
            <a href="./Appointments.php"><input class = "nav-buttons" id="appointments" type="button" value="Appointments"></a>
            <a href="./Patient_Add.php"><input class = "nav-buttons" id = "add-patient" type="button" value="Add Patient"></a> 
            <a href="./Index.php"><input class = "logout-button" id="logout" type="button" href value="Logout"></a>
        </ul>
    </aside>
    <main>
        <form class = "pat-add-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Add Patient</h1>
            <div class="group" id="name-div">
                <label for="name">Name</label>
                <input name="name" type="text">
            </div>
            <div class="group" id="age-div">
                <label for="age">Age</label>
                <input name="age" type="text">
            </div>
            <div class="group" id="gender-div">
                <label for="sex">Gender</label>
                <input name="sex" type="text">
            </div>
            <div class="group" id="address-div">
                <label for="address">Address</label>
                <input name="address" type="text">
            </div>
            <div class="group" id="contact-div">
                <label for="contact">Contact</label>
                <input name="contact" type="text">
            </div>
            <div class="group" id="admission-div">
                <label for="admission">Admission</label>
                <input name="admission" type="date">
            </div>
            <div class="group" id="blood-div">
                <label for="blood">Blood Group</label>
                <input name="blood" type="text">
            </div>
            <input id = "save-patient" name = "save-patient" type="submit" value="Save Patient">
            <!-- <img id="add-patient-image" src="./images/Patient-Add-3.png" alt="Add Patient"> -->
        </form>
    </main>