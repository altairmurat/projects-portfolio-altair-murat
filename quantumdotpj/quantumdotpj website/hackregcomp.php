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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $telegram = $_POST["telegram"];

    // Insert data into database
    $sql = "INSERT INTO hr (Name, Surname, Telegram) VALUES ('$name', '$surname', '$telegram')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>