<?php include 'includes/Header.php'?>

    <link rel="stylesheet" href="css/Dasboard_new.css">
</head>
<body>

    <div class="navbar">
        <nav>
            <ul>
                <h4 id = "Logo">SereneCare</h4>
                <a href="Dashboard.php">Home</a>
                <a href="Patient">Patient</a>
                <a href="Doctors">Doctors</a>
                <a href="Employees">Employees</a>
                <a href="Login.php">
                <input class = "login-button" type="button" href value="Logout">
                </a>
            </ul>
        </nav>
    </div>
    
    <div class="body-grids">
        <div id="cards">
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                    <img id = "doc" src="./images/Add-Patient.png" alt="Doc">
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="fa-duotone fa-apartment"></i>
                            <div class="card-info-title">
                                <a href="./Index.php"><h3>Add Patients</h3></a>  
                                <h4>Add Patients to database</h4>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content" id="Billings">
                <div class="card-image">
                    <img id = "doc" src="./images/Billing.png" alt="Doc">
                </div>
                <div class="card-info-wrapper">
                    <div class="card-info">
                        <i class="fa-duotone fa-unicorn"></i>
                        <div class="card-info-title">
                            <h3>Billings</h3>  
                            <h4>Check billing details</h4>
                        </div>    
                    </div>  
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-image">
                <img id = "doc" src="./images/Docotors-white.png" alt="Doc">
                </div>
                <div class="card-info-wrapper">
                    <div class="card-info">
                        <!-- <img id = "doc" src="./images/Untitled-2.png" alt="Doc"> -->
                        <div class="card-info-title">
                            <h3>Doctors</h3>  
                            <h4>View doctor appointments</h4>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-image">
                <img id = "doc" src="./images/View-Patients.png" alt="Doc">

                </div>
                <div class="card-info-wrapper">
                    <div class="card-info">
                        <i class="fa-duotone fa-person-to-portal"></i>
                        <div class="card-info-title">
                            <h3>View Patients</h3>  
                            <h4>View all patients from the database</h4>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-image">
                <img id = "doc" src="./images/Employee2.png" alt="Doc">
                </div>
                <div class="card-info-wrapper">
                    <div class="card-info">
                        <i class="fa-duotone fa-person-from-portal"></i>
                        <div class="card-info-title">
                            <h3>View Employees</h3>  
                            <h4>View employee details</h4>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-image">
                <img id = "doc" src="./images/Appointments.png" alt="Doc">
                </div>
                <div class="card-info-wrapper">
                    <div class="card-info">
                        <i class="fa-duotone fa-otter"></i>
                        <div class="card-info-title">
                            <h3>Add Appointments</h3>  
                            <h4>Add doctors appointments</h4>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src = "includes/Dashboard.js"></script>
    
</body>
</html>