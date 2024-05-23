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
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];

    // Prepare SQL statement to insert data into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (customer_id, order_date, status) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("iss", $customer_id, $order_date, $status);
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
