<?php
// Establish database connection (replace with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "handmade";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$names = $_POST['names'];
$username = $_POST['username'];
$email = $_POST['email'];
$tel_number = $_POST['tel_number'];
$password = $_POST['password'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert user data into the database
$sql = "INSERT INTO Users (Names, Username, Email, telephone, hashed_password)
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
} else {
    $stmt->bind_param("sssss", $names, $username, $email, $telephone, $hashed_password);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "New record created successfully. <a href='login.html'>Go back to login page</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
