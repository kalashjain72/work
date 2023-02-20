<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    echo "Connection was successful<br>";
}

$sql="SELECT * FROM `datebase`";
$result = mysqli_query($conn, $sql);
$num= mysqli_num_rows($result);

if ($num > 0) {

    while (($row = mysqli_fetch_assoc($result)) != null) {


        echo $row['S.No'] . " hello " . $row['Name'] . " your role is " . $row['Role']."<br>";

    }
}


?>