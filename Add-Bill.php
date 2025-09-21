<?php 
    include 'includes/Header.php';

    if(isset($_POST["add-bill"])) {
        $pat = new Billings();
        $pat->AddToDB($conn);
    }
?>

    <link rel="stylesheet" href="css/Add-Bill.css">
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
            <h1>Add Bills</h1>
            <div class="group" id="pat-id-div">
                <label for="pat_id">Patient ID</label>
                <input name="pat_id" type="text">
            </div>
            <div class="group" id="pat-name-div">
                <label for="pat_name">Patient Name</label>
                <input name="pat_name" type="text">
            </div>
            <div class="group" id="treatment-div">
                <label for="treatment">Treatment</label>
                <input name="treatment" type="text">
            </div>
            <div class="group" id="med-code-div">
                <label for="med-code">Medicine Code</label>
                <input name="med-code" type="text">
            </div>
            <div class="group" id="med-price-div">
                <label for="med-price">Medicine Price</label>
                <input name="med-price" type="text">
            </div>
            <div class="group" id="equip-price-div">
                <label for="equip-price">Equipment Price</label>
                <input name="equip-price" type="text">
            </div>
            <input id = "add-bill" name = "add-bill" type="submit" value="Add Bill">
        </form>
    </main>