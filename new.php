<?php 

$con = mysqli_connect('localhost','Niranjan','root','hospital');
if($con){
    if(isset($_POST['submit'])) {
        $a=$_POST['roomid'];
        $b=$_POST['type'];
        $c=$_POST['pidid'];
        $d=$_POST['pname'];
        $e=$_POST['nid'];
        $f=$_POST['nname'];
        $res="insert into rooms values ('$a','$b','$c','$d','$e','$f')";
        $sql=mysqli_query($con,$res);
        if($sql){
            echo "success";
        }
    }
}



?>


<html>
    <head>
        <title>INPUT</title>
    </head>
    <body>
        <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <label for="roomid">Room ID</label>
            <input type="number" name="roomid">
            <br>
            <label >Type</label>
            <input type="text" name="type">
            <br>
            <label>Pid ID</label>
            
            <input type="number" name="pidid">
            <br>
            <label>Pname</label>
            <input type="text" name="pname">
            <br>
            <label>nid</label>
            <input type="number" name="nid">
            <br>
            <label>nname</label>
            <input type="text" name="nname">
            <br>
            <input type="submit" name="submit">
        </form>

    </body>
</html>