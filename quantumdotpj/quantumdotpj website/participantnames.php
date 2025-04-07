<?php
$servername = "localhost";
$username = "c778043d_ict2";
$password = "Hello123";
$dbname = "c778043d_ict2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$telegram = $_GET['Telegram'];

// Prepare and bind the statement
$stmt = $conn->prepare("SELECT Telegram FROM hr WHERE Telegram = ?");
$stmt->bind_param("s", $telegram);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "This telegram nickname already exists in registration database, please, use another";
} else {
    echo "Telegram nickname was not found. You may use it to register to our hackathon";
}

$stmt->close();
$conn->close();
?>