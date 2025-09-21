<?php 

class User {
    private $name;
    private $username;
    private $email;
    private $password;

    public function register($conn){

        $this->username = filter_input(INPUT_POST,'nu-username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->name = filter_input(INPUT_POST,'nu-name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->email = filter_input(INPUT_POST,'nu-email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->password = filter_input(INPUT_POST,'nu-password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$this->username' OR email = '$this->email'");
        
        if (mysqli_num_rows($duplicate) > 0) {
            echo "<script> alert('Username or Email has already been taken'); </script>";
        } else {
            $sql = "INSERT INTO `users` 
            (`username`, `name`, `email`, `password`) 
            VALUES 
            ('$this->username', '$this->name', '$this->email', '$this->password');";
            mysqli_query($conn, $sql);
            echo "<script> alert('Registration Successful'); </script>";
        }
    }

    public function login($conn) {
        $this->username = filter_input(INPUT_POST,'li-username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->password = filter_input(INPUT_POST,'li-password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $verify = mysqli_query($conn, "SELECT * FROM users WHERE username = '$this->username'");
        // echo var_dump($verify);
        $row = mysqli_fetch_assoc($verify);
        // echo var_dump($row);

        if (mysqli_num_rows($verify) > 0) {
            if ($this->password == $row["password"]) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                header("Location: ../Dashboard.php");
            } else {
            echo "<script> alert('Wrong Password'); </script>";
            }
        } else {
            echo "<script> alert('User not registered'); </script>";
        }
    }
}

class Patient {

    private $id;
    private $name;
    private $age;
    private $gender;
    private $address;
    private $contact;
    private $blood;
    private $admission;
    private $dis_date;

    public function AddToDB($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(p_id) FROM `patients`");
        $this->id = mysqli_fetch_all($res)[0][0] + 1;
        $this->name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->age = filter_input(INPUT_POST,'age', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->gender = filter_input(INPUT_POST,'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->address = filter_input(INPUT_POST,'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->contact = filter_input(INPUT_POST,'contact', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->blood = filter_input(INPUT_POST,'blood', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->admission = filter_input(INPUT_POST,'admission', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO `patients` 
        (`name`, `age`, `sex`, `address`, `admission`, `contact`,`blood`) 
        VALUES 
        ('$this->name', '$this->age', '$this->gender', '$this->address', '$this->admission', '$this->contact', '$this->blood');";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Patient added to database'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }

    public function Discharge($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(room_id) FROM `rooms`");
        $this->id = mysqli_fetch_all($res)[0][0] + 1;
        $this->id = filter_input(INPUT_POST,'dis_pat_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->dis_date = filter_input(INPUT_POST,'dis_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "UPDATE `patients` SET `discharge` = '$this->dis_date' WHERE `patients`.`p_id` = $this->id;";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Discharge Assigned'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }
    
}

class Patient_Dete {

    public function Show_Patients($conn) {
        $result = mysqli_query($conn, "SELECT * FROM `patients`");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['name']. "</td>";
            echo "<td class = 'tdata'>". $item['age']. "</td>";
            echo "<td class = 'tdata'>". $item['sex']. "</td>";
            echo "<td class = 'tdata'>". $item['address']. "</td>";
            echo "<td class = 'tdata'>". $item['contact']. "</td>";
            echo "<td class = 'tdata'>". $item['blood']. "</td>";
            echo "<td class = 'tdata'>". $item['admission']. "</td>";
            echo "<td class = 'tdata'>". $item['discharge']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Search($conn) {

        $name = filter_input(INPUT_POST,'Searchbar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `patients` WHERE name like '%$name%'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td>". $item['p_id']. "</td>";
            echo "<td>". $item['name']. "</td>";
            echo "<td>". $item['age']. "</td>";
            echo "<td>". $item['sex']. "</td>";
            echo "<td>". $item['address']. "</td>";
            echo "<td>". $item['contact']. "</td>";
            echo "<td>". $item['blood']. "</td>";
            echo "<td>". $item['admission']. "</td>";
            echo "<td>". $item['discharge']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Discharge($conn) {
        // $result = mysqli_query($conn, "SELECT COUNT(`p_id`) FROM `patients` WHERE `discharge` = CURDATE();");
        $result = mysqli_query($conn, "SELECT * FROM `patients` WHERE `discharge` = CURDATE();");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $count = count($details);

        if ($count == 0) {
            echo "<tr>";
            echo "<td class = 'dis_data'>". "No Discharge Today". "</td>";
            echo "</tr>";
        } else if ($count < 2) {
            echo "<tr>";
            echo "<td class = 'dis_data'>". $details[0]['name']. "</td>";
            echo "<td class = 'dis_data'>". $details[0]['p_id']. "</td>";
            echo "</tr>";
        } else if ($count == 2) {
            echo "<tr>";
            echo "<td class = 'dis_data'>". $details[0]['name']. "</td>";
            echo "<td class = 'dis_data'>". $details[0]['p_id']. "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class = 'dis_data'>". $details[1]['name']. "</td>";
            echo "<td class = 'dis_data'>". $details[1]['p_id']. "</td>";
            echo "</tr>";
        }

        
    }

    public function Pat_Count($conn) {

        $result = mysqli_query($conn, "SELECT COUNT(`p_id`) FROM `patients`;");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
        echo "<tr>";
        echo "<td class = 'tdata'>". $item['COUNT(`p_id`)']. "</td>";
        echo "</tr>";
        endforeach;
    }
}

class Employee {

    private $emp_id;
    private $name;
    private $age;
    private $gender;
    private $address;
    private $contact;
    private $role;
    private $employment_type;
    private $salary;
    private $qualification;

    public function AddToDB($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(emp_id) FROM `employees`");
        $this->emp_id = mysqli_fetch_all($res)[0][0] + 1;
        $this->name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->age = filter_input(INPUT_POST,'age', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->gender = filter_input(INPUT_POST,'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->address = filter_input(INPUT_POST,'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->contact = filter_input(INPUT_POST,'contact', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->role = filter_input(INPUT_POST,'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->employment_type = filter_input(INPUT_POST,'employment_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->salary = filter_input(INPUT_POST,'salary', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->qualification = filter_input(INPUT_POST,'qualification', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $this->doctor = filter_input(INPUT_POST,'p_doctor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO `employees` 
        (`name`, `dob`, `sex`, `address`, `contact`, `role`, `employment_type`, `salary`, `qualification`) 
        VALUES 
        ('$this->name', '$this->age', '$this->gender', '$this->address', '$this->contact', '$this->role', '$this->employment_type', '$this->salary', '$this->qualification');";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Employee added to database'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }
}

class Employee_Dete {

    public function Show_Employee($conn) {
        $result = mysqli_query($conn, "SELECT * FROM `employees`");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['emp_id']. "</td>";
            echo "<td class = 'tdata'>". $item['name']. "</td>";
            echo "<td class = 'tdata'>". $item['dob']. "</td>";
            echo "<td class = 'tdata'>". $item['sex']. "</td>";
            echo "<td class = 'tdata'>". $item['address']. "</td>";
            echo "<td class = 'tdata'>". $item['contact']. "</td>";
            echo "<td class = 'tdata'>". $item['role']. "</td>";
            echo "<td class = 'tdata'>". $item['employment_type']. "</td>";
            echo "<td class = 'tdata'>". $item['salary']. "</td>";
            echo "<td class = 'tdata'>". $item['qualification']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Search($conn) {

        $name = filter_input(INPUT_POST,'Searchbar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `employees` WHERE name like '%$name%'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['emp_id']. "</td>";
            echo "<td class = 'tdata'>". $item['name']. "</td>";
            echo "<td class = 'tdata'>". $item['dob']. "</td>";
            echo "<td class = 'tdata'>". $item['sex']. "</td>";
            echo "<td class = 'tdata'>". $item['address']. "</td>";
            echo "<td class = 'tdata'>". $item['contact']. "</td>";
            echo "<td class = 'tdata'>". $item['role']. "</td>";
            echo "<td class = 'tdata'>". $item['employment_type']. "</td>";
            echo "<td class = 'tdata'>". $item['salary']. "</td>";
            echo "<td class = 'tdata'>". $item['qualification']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Show_Doctors($conn) { 
        $result = mysqli_query($conn, "SELECT * FROM `employees` WHERE role like 'Doctor'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['emp_id']. "</td>";
            echo "<td class = 'tdata'>". $item['name']. "</td>";
            echo "<td class = 'tdata'>". $item['dob']. "</td>";
            echo "<td class = 'tdata'>". $item['sex']. "</td>";
            echo "<td class = 'tdata'>". $item['address']. "</td>";
            echo "<td class = 'tdata'>". $item['contact']. "</td>";
            echo "<td class = 'tdata'>". $item['role']. "</td>";
            echo "<td class = 'tdata'>". $item['employment_type']. "</td>";
            echo "<td class = 'tdata'>". $item['salary']. "</td>";
            echo "<td class = 'tdata'>". $item['qualification']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Doc_Count($conn) {

        $result = mysqli_query($conn, "SELECT COUNT(`emp_id`) FROM `employees` WHERE `role` = 'Doctor';");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
        echo "<tr>";
        echo "<td class = 'tdata'>". $item['COUNT(`emp_id`)']. "</td>";
        echo "</tr>";
        endforeach;
    }

    public function Nurse_Count($conn) {

        $result = mysqli_query($conn, "SELECT COUNT(`emp_id`) FROM `employees` WHERE `role` = 'Nurse';");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
        echo "<tr>";
        echo "<td class = 'tdata'>". $item['COUNT(`emp_id`)']. "</td>";
        echo "</tr>";
        endforeach;
    }

    public function Search_Doc($conn) {

        $name = filter_input(INPUT_POST,'Searchbar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `employees` WHERE name like '%$name%' and role like 'Doctor'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['emp_id']. "</td>";
            echo "<td class = 'tdata'>". $item['name']. "</td>";
            echo "<td class = 'tdata'>". $item['dob']. "</td>";
            echo "<td class = 'tdata'>". $item['sex']. "</td>";
            echo "<td class = 'tdata'>". $item['address']. "</td>";
            echo "<td class = 'tdata'>". $item['contact']. "</td>";
            echo "<td class = 'tdata'>". $item['role']. "</td>";
            echo "<td class = 'tdata'>". $item['employment_type']. "</td>";
            echo "<td class = 'tdata'>". $item['salary']. "</td>";
            echo "<td class = 'tdata'>". $item['qualification']. "</td>";
            echo "</tr>";
        endforeach;
    }
}

class Appointments {

    private $record_no;
    private $p_name;
    private $p_id;
    private $d_name;
    private $d_id;
    private $appointment;
    private $time;
    private $condition;

    public function AddToDB($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(record_no) FROM `records`");
        $this->record_no = mysqli_fetch_all($res)[0][0] + 1;
        $this->p_name = filter_input(INPUT_POST,'pat_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->p_id = filter_input(INPUT_POST,'pat_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->d_name = filter_input(INPUT_POST,'doctor-name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->d_id = filter_input(INPUT_POST,'doctor-id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->appointment = filter_input(INPUT_POST,'appointment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->time = filter_input(INPUT_POST,'time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->condition = filter_input(INPUT_POST,'condition', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $this->doctor = filter_input(INPUT_POST,'p_doctor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO `records` 
        (`record_no`, `p_name`, `p_id`, `d_name`, `d_id`, `appointment`, `time`, `condition`) 
        VALUES 
        ('$this->record_no', '$this->p_name', '$this->p_id', '$this->d_name', '$this->d_id', '$this->appointment', '$this->time', '$this->condition');";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Appointment added to database'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }
}

class Appointment_detes {

    public function Show_Appointments($conn) {
        $result = mysqli_query($conn, "SELECT * FROM `records`");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            // echo "<td class = 'tdata'>". $item['record_no']. "</td>";
            echo "<td class = 'tdata'>". $item['p_name']. "</td>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['d_name']. "</td>";
            echo "<td class = 'tdata'>". $item['d_id']. "</td>";
            echo "<td class = 'tdata'>". $item['appointment']. "</td>";
            echo "<td class = 'tdata'>". $item['time']. "</td>";
            echo "<td class = 'tdata'>". $item['condition']. "</td>";
        endforeach;
    }

    public function Search($conn) {

        $name = filter_input(INPUT_POST,'Searchbar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `records` WHERE name like '%$name%'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['record_no']. "</td>";
            echo "<td class = 'tdata'>". $item['p_name']. "</td>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['d_name']. "</td>";
            echo "<td class = 'tdata'>". $item['d_id']. "</td>";
            echo "<td class = 'tdata'>". $item['appointment']. "</td>";
            echo "<td class = 'tdata'>". $item['time']. "</td>";
            echo "<td class = 'tdata'>". $item['condition']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Emergency($conn) {

        $result = mysqli_query($conn, "SELECT * FROM `records` where `condition` = 'Emergency';");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo "<tr>";
        echo "<td class = 'dis_data'>". $details[0]['p_name']. "</td>";
        echo "<td class = 'dis_data'>". $details[0]['p_id']. "</td>";
        echo "</tr>";
    }

    public function Dash_Appointments($conn) {
        $result = mysqli_query($conn, "SELECT * FROM `records`");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $i = count($details);

        // var_dump($details);
        if ($i < 6) {
            for ($j = 0; $j < $i; $j++){
                echo "<tr>";
                echo "<td class = 'tdata'>". $details[$j]['p_name']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['d_name']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['appointment']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['time']. "</td>";
            }
        } else {
            for ($j = 1; $j < 6; $j++){
                echo "<tr>";
                echo "<td class = 'tdata'>". $details[$j]['p_name']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['d_name']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['appointment']. "</td>";
                echo "<td class = 'tdata'>". $details[$j]['time']. "</td>";
            }
        }

    }

}

class Billings {

    private $bill_no;
    private $p_id;
    private $p_name;
    private $treatment;
    private $med_code;
    private $med_price;
    private $equip_price;

    public function AddToDB($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(bill_no) FROM `billings`");
        $this->bill_no = mysqli_fetch_all($res)[0][0] + 1;
        $this->p_id = filter_input(INPUT_POST,'pat_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->p_name = filter_input(INPUT_POST,'pat_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->treatment = filter_input(INPUT_POST,'treatment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->med_code = filter_input(INPUT_POST,'med-code', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->med_price = filter_input(INPUT_POST,'med-price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->equip_price = filter_input(INPUT_POST,'equip-price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO `billings` 
        (`p_id`, `p_name`, `treatment`, `med_code`, `med_price`, `equip_price`) 
        VALUES 
        ('$this->p_id', '$this->p_name', '$this->treatment', '$this->med_code', '$this->med_price', '$this->equip_price');";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Bill added to database'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }
}

class Billing_detes {

    public function Show_Billings($conn) {
        $result = mysqli_query($conn, "SELECT * FROM `billings`");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['bill_no']. "</td>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['p_name']. "</td>";
            echo "<td class = 'tdata'>". $item['treatment']. "</td>";
            echo "<td class = 'tdata'>". $item['med_code']. "</td>";
            echo "<td class = 'tdata'>". $item['med_price']. "</td>";
            echo "<td class = 'tdata'>". $item['equip_price']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Income($conn) {
        $result = mysqli_query($conn, "SELECT SUM(`med_price`), SUM(`equip_price`) FROM `billings`;");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // echo "<br>";
        echo "<h4> Medicines :<br>Rs. ".$details[0]['SUM(`med_price`)']."</h4>";
        echo "<h4> Equipment :<br>Rs. ".$details[0]['SUM(`equip_price`)']."</h4>";
    }
    
    public function Search($conn) {

        $name = filter_input(INPUT_POST,'Searchbar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `billings` WHERE name like '%$name%'");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['bill_no']. "</td>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['p_name']. "</td>";
            echo "<td class = 'tdata'>". $item['treatment']. "</td>";
            echo "<td class = 'tdata'>". $item['med_code']. "</td>";
            echo "<td class = 'tdata'>". $item['med_price']. "</td>";
            echo "<td class = 'tdata'>". $item['equip_price']. "</td>";
            echo "</tr>";
        endforeach;
    }

}

class Rooms {

    private $room_id;
    private $type;
    private $p_id;
    private $p_name;
    private $n_id;
    private $n_name;

    public function AddToDB($conn){

        $this->room_id = filter_input(INPUT_POST,'room_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->p_id = filter_input(INPUT_POST,'p_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->n_id = filter_input(INPUT_POST,'n_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $names_sql = mysqli_query($conn, "SELECT `patients`.`name` AS 'patient', `employees`.`name` AS 'nurse' FROM `patients`, `employees` WHERE `patients`.`p_id` = '$this->p_id' AND `employees`.`emp_id` = '$this->n_id';");
        $names = mysqli_fetch_all($names_sql);
        $this->p_name = $names[0][0];
        $this->n_name = $names[0][1];

        $sql = "UPDATE `rooms` SET `p_id` = '$this->p_id', `p_name` = '$this->p_name' , `n_id` = '$this->n_id', `n_name` = '$this->n_name' WHERE `room_id` = '$this->room_id';";
        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Room Allocated'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }

    public function Deal_Room($conn){
        
        $res = mysqli_query($conn, "SELECT MAX(room_id) FROM `rooms`");
        $this->room_id = mysqli_fetch_all($res)[0][0] + 1;
        $this->room_id = filter_input(INPUT_POST,'room_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "UPDATE `rooms` SET `p_id` = NULL, `p_name` = NULL , `n_id` = NULL, `n_name` = NULL WHERE `room_id` = '$this->room_id';";

        $res = mysqli_query($conn, $sql);

        if($res) 
            echo "<script> alert('Room Deallocated'); </script>";
        else 
        echo "<script> alert('Error'); </script>";
    }
}

class Rooms_Available {

    private $type;

    public function Show_Rooms($conn) {

        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `rooms` WHERE `type` = '$this->type' AND `p_id` IS NULL;");
        // $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id`, `employees`.`name` FROM `employees`, `rooms` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` != `rooms`.`n_id`;");
        $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id` FROM `employees`, `rooms` WHERE `rooms`.`n_id` IS NOT NULL AND `employees`.`emp_id` != `rooms`.`n_id` AND `employees`.`role` = 'Nurse';");
        // $patients = mysqli_query($conn, "SELECT `patients`.`p_id`, `patients`.`name` FROM `patients`, `rooms` WHERE `patients`.`p_id` != `rooms`.`p_id`;");
        $patients = mysqli_query($conn, "SELECT `patients`.`p_id` FROM `patients`, `rooms` WHERE `rooms`.`p_id` IS NOT NULL AND `patients`.`p_id` != `rooms`.`p_id`;");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $nurse_ids = mysqli_fetch_all($nurse, MYSQLI_ASSOC);
        $pat_ids = mysqli_fetch_all($patients, MYSQLI_ASSOC);


        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['room_id']. "</td>";
            echo "<td class = 'tdata'>". $item['type']. "</td>";
        endforeach;
    }

    public function Show_Rooms_Mini($conn) {

        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT `rooms`.`type`, COUNT(`rooms`.`type`) AS 'availability' FROM `rooms` WHERE `rooms`.`p_id` IS NULL GROUP BY `rooms`.`type`;");
        // $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id`, `employees`.`name` FROM `employees`, `rooms` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` != `rooms`.`n_id`;");
        $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id` FROM `employees`, `rooms` WHERE `rooms`.`n_id` IS NOT NULL AND `employees`.`emp_id` != `rooms`.`n_id` AND `employees`.`role` = 'Nurse';");
        // $patients = mysqli_query($conn, "SELECT `patients`.`p_id`, `patients`.`name` FROM `patients`, `rooms` WHERE `patients`.`p_id` != `rooms`.`p_id`;");
        $patients = mysqli_query($conn, "SELECT `patients`.`p_id` FROM `patients`, `rooms` WHERE `rooms`.`p_id` IS NOT NULL AND `patients`.`p_id` != `rooms`.`p_id`;");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $nurse_ids = mysqli_fetch_all($nurse, MYSQLI_ASSOC);
        $pat_ids = mysqli_fetch_all($patients, MYSQLI_ASSOC);


        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['type']. "</td>";
            echo "<td class = 'tdata'>". $item['availability']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Nurse_Avail($conn) {

        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `rooms` WHERE `type` = '$this->type' AND `p_id` IS NULL;");
        // $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id`, `employees`.`name` FROM `employees`, `rooms` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` != `rooms`.`n_id`;");
        $nurse = mysqli_query($conn, "SELECT DISTINCT `employees`.`emp_id` FROM `employees` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` NOT IN (SELECT `rooms`.`n_id` FROM `rooms` WHERE `rooms`.`n_id` IS NOT NULL);");
        $patients = mysqli_query($conn, "SELECT `patients`.`p_id` FROM `patients` WHERE `patients`.`p_id` NOT IN (SELECT `rooms`.`p_id` FROM `rooms` WHERE `p_id` IS NOT NULL);");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $nurse_ids = mysqli_fetch_all($nurse, MYSQLI_ASSOC);
        $pat_ids = mysqli_fetch_all($patients, MYSQLI_ASSOC);

        foreach ($nurse_ids as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['emp_id']. "</td>";
            echo "</tr>";
        endforeach;
    }

    public function Patient_Avail($conn) {

        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `rooms` WHERE `type` = '$this->type' AND `p_id` IS NULL;");
        // $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id`, `employees`.`name` FROM `employees`, `rooms` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` != `rooms`.`n_id`;");
        $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id` FROM `employees`, `rooms` WHERE `rooms`.`n_id` IS NOT NULL AND `employees`.`emp_id` != `rooms`.`n_id` AND `employees`.`role` = 'Nurse';");
        // $patients = mysqli_query($conn, "SELECT `patients`.`p_id`, `patients`.`name` FROM `patients`, `rooms` WHERE `patients`.`p_id` != `rooms`.`p_id`;");
        $patients = mysqli_query($conn, "SELECT `patients`.`p_id` FROM `patients` WHERE `patients`.`p_id` NOT IN (SELECT `rooms`.`p_id` FROM `rooms` WHERE `p_id` IS NOT NULL);");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $nurse_ids = mysqli_fetch_all($nurse, MYSQLI_ASSOC);
        $pat_ids = mysqli_fetch_all($patients, MYSQLI_ASSOC);

        foreach ($pat_ids as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "</tr>";
        endforeach;
    }


    public function Show_Alo_Rooms($conn) {

        $this->type = filter_input(INPUT_POST,'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $result = mysqli_query($conn, "SELECT * FROM `rooms` WHERE `type` = '$this->type' AND `p_id` IS NOT NULL;");
        $nurse = mysqli_query($conn, "SELECT `employees`.`emp_id`, `employees`.`name` FROM `employees`, `rooms` WHERE `employees`.`role` = 'Nurse' AND `employees`.`emp_id` = `rooms`.`n_id`;");
        $patients = mysqli_query($conn, "SELECT `patients`.`p_id`, `patients`.`name` FROM `patients`, `rooms` WHERE `patients`.`p_id` = `rooms`.`p_id`;");
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $nurse_ids = mysqli_fetch_all($nurse, MYSQLI_ASSOC);
        $pat_ids = mysqli_fetch_all($patients, MYSQLI_ASSOC);


        foreach ($details as $item):
            echo "<tr>";
            echo "<td class = 'tdata'>". $item['room_id']. "</td>";
            echo "<td class = 'tdata'>". $item['type']. "</td>";
            echo "<td class = 'tdata'>". $item['p_id']. "</td>";
            echo "<td class = 'tdata'>". $item['p_name']. "</td>";
            echo "<td class = 'tdata'>". $item['n_id']. "</td>";
            echo "<td class = 'tdata'>". $item['n_name']. "</td>";
        endforeach;
    }
}