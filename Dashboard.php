<?php 
    include 'includes/Header.php';
    require './Config/login_config.php';

    if(!empty($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $result = mysqli_query($conn, "SELECT name FROM users WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: ./Login.php");
    }

    $detes = new Appointment_detes();
    $pat_detes = new Patient_Dete();
    $emp_detes = new Employee_Dete();
    $avail = new Rooms_Available();
    $bills = new Billing_detes();

    
?>

    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
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
        <!-- <ul>
            <a href="./Billings.php"><button class = "nav-buttons" id="bill"><img src="../images/bill-svgrepo-com.svg" class="color-svg"> Billings</button></a>
            <a href="./Patient_View.php"><button class = "nav-buttons" id="pat"><img src="../images/patient-profile-people-svgrepo-com.svg" alt="" class="color-svg">Patient</button></a>
            <a href="./Doctors.php"><button class = "nav-buttons" id="doc"><img src="../images/doctor-svgrepo-com.svg" alt="" class="color-svg">Doctors</button></a>
            <a href="./Employees.php"><button class = "nav-buttons" id="emp"><img src="../images/employee-svgrepo-com.svg" alt="" class="color-svg">Employees</button></a>
            <a href="./Appointments.php"><button class = "nav-buttons" id="app"><img src="../images/appointment-new-svgrepo-com.svg" alt="" class="color-svg">Appointments</button></a>
            <a href="./Patient_Add.php"><button class = "nav-buttons" id="add-patient-button"><img src="../images/plus-1512-svgrepo-com.svg" alt="" class="color-svg">Add Patient</button></a>
            <a href="./Index.php"><button class = "nav-buttons" id = "logout-button"><img src="../images/" alt="">Logout</button></a>
        </ul> -->

        <ul>
            <a href="./Billings.php"><input class = "nav-buttons" id="billings" type="button" value="Billings"></a>
            <a href="./Patient_View.php"><input class = "nav-buttons" id="patient-view" type="button" value="Patients"></a>
            <a href="./Doctors.php"><input class = "nav-buttons" id="doctors" type="button" value="Doctors"></a>
            <a href="./Employees.php"><input class = "nav-buttons" id="employees" type="button" value="Employees"></a>
            <a href="./Appointments.php"><input class = "nav-buttons" id="app" type="button" value="Appointments"></a>
            <a href="./Patient_Add.php"><input class = "nav-buttons" id = "add-patient" type="button" value="Add Patient"></a> 
            <a href="./Index.php"><input class = "logout-button" id="logout" type="button" href value="Logout"></a>  
        </ul>
        
    </aside>
    <main>
        <div class="container">
            <div class="items" id="good-morning">
                <?php 
                date_default_timezone_set('Asia/Kolkata');

                if (date('a') == 'am') {
                    echo '<h3 id="gm">Good Morning</h3>';
                    echo '<h1 id="uname">'.$row["name"].'</h1>';
                    echo '<h3 id="ti">Time</h3>';
                    echo '<h2 id="tim">'.date("h:i a").'</h2>';
                    echo '<img src="./images/nature.png" alt="Morning">';
                } else {
                    echo '<h3 id="gm">Good Afternoon</h3>';
                    echo '<h1 id="uname">'.'$row["name"]'.'</h1>';
                    echo '<h3 id="ti">Time</h3>';
                    echo '<h2 id="tim">'.'echo date("h:i a")'.'</h2>';
                    echo '<img src="./images/day-and-night.png" alt="Afternoon">';
                }
                ?>
            </div>
            <div class="items" class = "calendar-grid" id="calendar">
                <!-- <h3>Calendar</h3> -->
                <div class="wrapper">
                    <header>
                        <p class="current-date"></p>
                        <div class="icons">
                        <span id="prev" class="material-symbols-rounded"></span>
                        <span id="next" class="material-symbols-rounded"></span>
                        </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                        </ul>
                        <ul class="days"></ul>
                    </div>
                </div>
                <div class="boxes3">
                    <div class="items" id="patients-s">
                        <h2>Patients</h2>
                        <div class="Count">
                        <?php $pat_detes->Pat_Count($conn); ?>
                    </div>
                    </div>
                    <div class="items" id="doctors-s">
                        <h2>Doctors</h2>
                        <!-- <h4>Doctors on <br/> Duty</h4> -->
                    <div class="Count">
                        <?php $emp_detes->Doc_Count($conn); ?>
                    </div>
                    </div>
                    <div class="items" id="nurses-s">
                        <h2>Nurses</h2>
                        <!-- <h4>Nurses on <br/> Duty</h4> -->
                        <div class="Count">
                        <?php $emp_detes->Nurse_Count($conn); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="items" id="rooms">
                <h3>Rooms <br/> Free</h3>

                <table id="rooms-mini">
                    <th>Type</th>
                    <th>Rooms</th>
                <?php $avail->Show_Rooms_Mini($conn); ?>
                </table>

                <button class="add-reco" id="Deallocate">Deallocate</button>
                <a href="./Room-Rem.php" id = "add-reco-dealo"><button class="add-reco" type = 'submit' name = 'add-record' id = 'add-record'><img src="../images/arrow-up-right-svgrepo-com.svg" class="color-svg"></button></a>

                <button class="add-reco" id="Allocate">Allocate</button>
                <a href="./Room-Add.php" id = "add-reco-alo"><button class="add-reco" type = 'submit' name = 'add-record' id = 'add-record'><img src="../images/arrow-up-right-svgrepo-com.svg" class="color-svg"></button></a>
            </div>
            <div class="items" id="patients">
                <h4>Emergency Cases</h4>
                <div class="emergency">
                    <table class="dis_table">
                        <th>Name</th>
                        <th>ID</th>
                        <?php $detes->Emergency($conn); ?>
                    </table>
                    <a href="./Appointments.php" class ="viewall">View All</a>
                </div>

            </div>
            <div class="items" id="billing">
                <h3>Total Income</h3>
                <div id="sum_amt">
                    <?php $bills->Income($conn); ?>
                </div>
            </div>
            <div class="items" id="discharge">
                <h4>Dicharging Today</h4>
                <div id="dis_table">
                    <table class="dis_table">
                        <th>Name</th>
                        <th>ID</th>
                        <?php $pat_detes->Discharge($conn); ?>
                    </table>
                <a href="./Patient_View.php" class ="viewall">View All</a>
                </div>
            </div>
            <div class="items" id="appointments">
                <h3>Doctor Appointments</h3>
                <table class="quick_app" id="app_table_mini">
                    <tr>
                        <th class="heading">Patient Name</th>
                        <th class="heading">Doctor Name</th>
                        <th class="heading">Appointment</th>
                        <th class="heading">Time</th>
                    </tr>
                <?php $detes->Dash_Appointments($conn); ?>
                </table>
                <a href="./Appointments.php" id = "go-appo"><button class="add-reco" type = 'submit' name = 'add-record' id = 'add-record'><img src="../images/arrow-up-right-svgrepo-com.svg" class="color-svg"></button></a>
            </div>
        </div>
    </main>
    <script src = "includes/Calendar.js"></script>
</body>
</html>