<?php 
    include 'includes/Header.php';

    if(isset($_POST["save-employee"])) {
        $emp = new Employee();
        $emp->AddToDB($conn);
    }
?>

    <link rel="stylesheet" href="css/Employees.css">
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
        <form class = "emp-add-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Add Employee</h1>
            <div class="group" id="name-div">
                <label for="name">Name</label>
                <input name="name" type="text">
            </div>
            <div class="group" id="dob-div">
                <label for="age">Date of birth</label>
                <input name="age" type="date">
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
            <div class="group" id="role-div">
                <label for="role">Role</label>
                <input name="role" type="text">
            </div>
            <div class="group" id="employment-div">
                <label for="employment_type">Employment-type</label>
                <input name="employment_type" type="text">
            </div>
            <div class="group" id="salary-div">
                <label for="salary">Salary</label>
                <input name="salary" type="text">
            </div>
            <div class="group" id="qualification-div">
                <label for="qualification">qualification</label>
                <input name="qualification" type="text">
            </div>
            <input id = "save-employee" name = "save-employee" type="submit" value="Save Employee">
            <!-- <img id="add-patient-image" src="./images/Patient_Add.png" alt="Add Patient"> -->
        </form>
    </main>