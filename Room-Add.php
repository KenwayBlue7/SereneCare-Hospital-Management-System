<?php 
    include 'includes/Header.php';

    $avail = new Rooms_Available();
    $avail_flag = 0;

    if(isset($_POST['Show'])) {
        $avail_flag = 1;
    }
    
    if(isset($_POST["allocate-room"])) {
        $add = new Rooms();
        $add->AddToDB($conn);
    }
?>

    <link rel="stylesheet" href="css/Room-Add.css">
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
        <div id="type_select">
            <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" >
                <input id = 'type' name = 'type' placeholder = 'Select Room Type' type = 'text' input>
                <button id = 'Show' name= 'Show' type = 'Submit'>Show Rooms</button>
            </form>
        </div>
        <table class="room-tables" id="room-type">
            <tr>
                <th class="heading">Rooms Available</th>
                <th class="heading">Type</th>
            </tr>
            <?php if($avail_flag == 1)
                $avail->Show_Rooms($conn);
            else
                echo "<tr>";
                    // echo "<td class = 'tdata'>". 'Please select type'. "</td>";
                echo "</tr>";
            ?>

        </table>

        <table class="room-tables" id="pat-table">
            <tr>
                <th class="heading">Patient ID</th>
            </tr>
            <?php if($avail_flag == 1)
                $avail->Patient_Avail($conn);
            else
                echo "<tr>";
                    // echo "<td class = 'tdata'>". 'Please select type'. "</td>";
                echo "</tr>";
            ?>
        </table>

        <table class="room-tables" id="nurse-table">
            <tr>
                <th class="heading">Nurse ID</th>
            </tr>
            <?php if($avail_flag == 1)
                $avail->Nurse_Avail($conn);
            else
                echo "<tr>";
                    // echo "<td class = 'tdata'>". 'Please select type'. "</td>";
                echo "</tr>";
            ?>
        </table>

        <form class = "emp-add-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Allocate Room</h1>
            <div class="group" id="room_id-div">
                <label for="room_id">Room ID</label>
                <input name="room_id" type="text">
            </div>
            <div class="group" id="p_id-div">
                <label for="p_id">Patient ID</label>
                <input name="p_id" type="text">
            </div>
            <div class="group" id="n_id-div">
                <label for="n_id">Nurse ID</label>
                <input name="n_id" type="text">
            </div>
            <div class="group" id="type-div">
                <label for="type">Type</label>
                <input name="type" type="text">
            </div>
            <input id = "allocate-room" name = "allocate-room" type="submit" value="Allocate">
        </form>

    </main>