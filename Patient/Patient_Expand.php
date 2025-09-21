<?php

include "inc/Header.php"; 
if (isset($_GET['id'])){
    $patient_id = $_GET['id'];
    echo $patient_id;
}

$sql = "SELECT * FROM Patient WHERE p_id =". $_GET['id']. ";";
$result = mysqli_query($conn, $sql);
$details = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<h1>Patient Info</h1>
<h2><?php echo $details[0]['p_name']?></h2>
<hr>
<?php foreach ($details as $item):
                echo "<tr>";
                echo "<td>". $item['p_id']. "</td>";
                echo "<td><a href='Patient_Expand.php?id=". $item['p_id']. "'>". $item['p_name']. "</a></td>";
                echo "<td>". $item['p_age']. "</td>";
                echo "</tr>";
            ?>
<?php endforeach ?>
