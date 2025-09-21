<?php 
    include 'includes/Header.php';
    $detes = new Employee_Dete();
    $flag = 0;

    if(isset($_POST['Search'])) {
        $flag = 1;
    }
?>

<link rel="stylesheet" href="css/Doctors.css">
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
        <h1 id="main_h1" >Doctors Details</h1>

        <div id="searchdiv">
            <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" >
                <input id = 'Searchbar' name = 'Searchbar' placeholder = 'Search Doctors' type = 'text' input>
                <button id = 'Search' name= 'Search' type = 'Submit'><img src="../images/magnifying-glass-svgrepo-com.svg" alt="Search"></button>
            </form>
        </div>
        
        <table>
            <tr>
                <th class="heading">Employee ID</th>
                <th class="heading">Name</th>
                <th class="heading">Date of Birth</th>
                <th class="heading">Gender</th>
                <th class="heading">Address</th>
                <th class="heading">Contact</th>
                <th class="heading">Role</th>
                <th class="heading">Employment Type</th>
                <th class="heading">Salary</th>
                <th class="heading">Qualifications</th>
            </tr>

            <?php if($flag == 1)
                $detes->Search_Doc($conn);
            else
                $detes->Show_Doctors($conn); 
            ?>
        </table>
        <a href="./Employees_add.php" id="add-pat-a"><button type = 'submit' name = 'add-record' id = 'add-record'>+</button></a>
    </main>
</body>
