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

// Usage of WHERE Clause to fetch data from the database


$sql = "SELECT * FROM `datebase` WHERE `Role`='Pro'";
$result = mysqli_query($conn, $sql);
$num= mysqli_num_rows($result);
echo $num . " records found in the DataBase<br>";

if ($num > 0) {

    while (($row = mysqli_fetch_assoc($result)) != null) {


        echo $row['S.No'] . " hello " . $row['Name'] . " your role is " . $row['Role']."<br>";

    }
}

$sql = "UPDATE `datebase` SET `Role` = 'sofwate trnee' WHERE `Role` = 'Pro'";
$result = mysqli_query($conn, $sql);
echo var_dump($result);
$aff = mysqli_affected_rows($conn);
echo "<br>Number of affected rows: $aff <br>";
if($result){
    echo "We updated the record successfully";
}
else{
    echo "We could not update the record successfully";
}

?>