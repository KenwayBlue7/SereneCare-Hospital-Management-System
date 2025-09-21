<?php 
    include 'includes/Header.php';

    if(isset($_POST["add-appointment"])) {
        $pat = new Appointments();
        $pat->AddToDB($conn);
    }
?>

    <link rel="stylesheet" href="css/Appointments_Add.css">
    </head>

<body>
    <aside>
        <div class="logo-title">
            <img src="./images/SereneCare-logo-white-50.png" alt="SereneCare">
            <h2>SereneCare</h2>
        </div>
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
            <h1>Add Apppointment</h1>
            <div class="group" id="pat-name-div">
                <label for="pat_name">Patient Name</label>
                <input name="pat_name" type="text">
            </div>
            <div class="group" id="pat-id-div">
                <label for="pat_id">Patient ID</label>
                <input name="pat_id" type="text">
            </div>
            <div class="group" id="doc-name-div">
                <label for="doctor-name">Doctor Name</label>
                <input name="doctor-name" type="text">
            </div>
            <div class="group" id="doc-id-div">
                <label for="doctor-id">Doctor ID</label>
                <input name="doctor-id" type="text">
            </div>
            <div class="group" id="appointment-div">
                <label for="appointment">Appointment</label>
                <input name="appointment" type="date">
            </div>
            <div class="group" id="time-div">
                <label for="time">Time</label>
                <input name="time" type="time">
            </div>
            <div class="group" id="condition-div">
                <label for="condition">Condition</label>
                <input name="condition" type="text">
            </div>
            <input id = "add-appointment" name = "add-appointment" type="submit" value="Add Appointment">
        </form>
    </main>