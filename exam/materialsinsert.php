<?php
// Establish database connection (replace with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    // Prepare and bind SQL statement to insert data into the materials table
    $stmt = $conn->prepare("INSERT INTO materials (name, quantity, unit) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $quantity, $unit);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "New record added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
