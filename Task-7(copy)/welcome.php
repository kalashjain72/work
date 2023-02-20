<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	// Redirect the user to the login page
	header("Location: login.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>
	<h2>Welcome</h2>
    <a href="phptask1.php"> Task 1</a><br>
    <a href="phptask2.php">Task 2</a><br>
    <a href="phptask3.php">Task 3</a> <br>
    <a href="phptask4.php">Task 4</a> <br>
    <a href="phptask5.php">Task 5</a> <br>
    <a href="phptask6.php">Task 6</a><br>
	
</body>
</html>

<?php
$q=null;
if(isset($_GET['q'])){
$question = $_GET['q'];
if ($question == 1) {
    header('Location: phptask1.php');}
    if ($question == 1) {
        header('Location: phptask1.php');}

    if ($question == 2) {
        header('Location: phptask2.php');}
    
        if ($question == 3) {
        header('Location: phptask3.php');}

    if ($question == 4) {
        header('Location: phptask4.php');}
                
    if ($question == 5) {
        header('Location: phptask5.php');}
        
     if ($question == 6) {
        header('Location: phptask6.php');}
                                    
}

?>