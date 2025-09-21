<?php

// $con = mysqli_connect(
//     'localhost', 
//     'Niranjan', 
//     'root', 
//     'hospital'
// );
include 'inc/Header.php';

$sql = "SELECT * FROM Patient;";
$result = mysqli_query($conn, $sql);
$details = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<body>
    <h1>Patient Details</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>

        <?php foreach ($details as $item):
                echo "<tr>";
                echo "<td>". $item['p_id']. "</td>";
                echo "<td><a href='Patient_Expand.php?id=". $item['p_id']. "'>". $item['p_name']. "</a></td>";
                echo "<td>". $item['p_age']. "</td>";
                echo "</tr>";
            ?>
        <?php endforeach ?>
            
    </table>
</body>
</html>