<?php
session_start();

// Define the list of valid credentials
$valid_credentials = array(
	"username1" => "password1",
	"username2" => "password2",
	"username3" => "password3"
);

// Check if the submitted credentials are valid
if (isset($_POST["username"]) && isset($_POST["password"]) && 
	in_array($_POST["username"], array_keys($valid_credentials)) && 
	$valid_credentials[$_POST["username"]] == $_POST["password"]) {

	// Set the session variable to indicate that the user is logged in
	$_SESSION["logged_in"] = true;
	
	// Redirect the user to the welcome question page 
	header("Location: welcome.php");
	exit();
} else {
	// Redirect the user back to the login page with an error message
    
	header("Location: login.html?error=invalid");
	exit();
}
?>
