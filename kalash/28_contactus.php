<?php

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    echo "Connection was successful<br> <br> <br>";
} ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>contact us form php </title>
  </head>
  <body>
    <form action="contactus.php" method="post">
      <label for="name">Name:</label>
      <input type="text" name="name" required /><br /><br />
      <label for="email">Email:</label>
      <input type="email" name="email" required /><br /><br />
      <label for="concern">concern:</label>
      <input type="text" name="concern" required /><br /><br />
      

      <input type="submit" value="Submit" />
    </form>
  </body>
</html>


<?php

$name = $email = $concern = "";



// Sql query to be executed



if(($_SERVER["REQUEST_METHOD"] == "POST")){

  $name = $_POST['name'];
$email = $_POST['email'];
$concern = $_POST['concern'];
$sql = "INSERT INTO `contactus` (`name`, `email`,`concern`) VALUES ('$name', '$email', '$concern')";
$result = mysqli_query($conn, $sql);

// Add a new trip to the Trip table in the database
if($result){
    echo "The record has been inserted successfully successfully!<br>";
}
else{
    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
}
}
 ?>