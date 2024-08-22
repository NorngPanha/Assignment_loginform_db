<?php
// Get POST data
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

// Check if both username and password are provided
if (empty($username)) {
    echo "Username should not be empty";
    exit();
}
if (empty($password)) {
    echo "Password should not be empty";
    exit();
}

// Database connection settings
$servername = "localhost";  // Change this if your database server is different
$db_username = "root";      // Change this to your database username
$db_password = "";          // Change this to your database password
$dbname = "login_db";       // Change this to your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO assignment_form_db (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

// Execute the statement
if ($stmt->execute()) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
