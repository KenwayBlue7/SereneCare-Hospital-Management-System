<?php
    include 'inc/Header.php';

    if (isset($_POST["Submit"])) {
        $pat = new Patient();
        $pat->AddToDB($conn);
    }
?>

    <form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1>Patient Details</h1>
        <div>
            <label for="p_name">Name : </label>
            <input type="text" name = "p_name">
        </div>
        <div>
            <label for="p_age">Age : </label>
            <input type="int" name = p_age>
        </div>
        <div>
            <label for="p_sex">Gender : </label>
            <input type="text" name = "p_sex">
        </div>
        <div>
            <label for="p_address">Address : </label>
            <input type="text" name = "p_address">
        </div>
        <div>
            <label for="p_admission">Admission Date : </label>
            <input type="date" name = "p_admission">
        </div>
        <div>
            <label for="p_contact">Contact No : </label>
            <input type="text" name = "p_contact">
        </div>
        <div>
            <label for="p_doctor">Consulting Doctor : </label>
            <input type="text" name = "p_doctor">
        </div>
        <input type="submit" value="Submit" name = "Submit">
    </form>
</body>
</html>