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

// Retrieve username and password from form submission
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement to retrieve user data from the database
$sql = "SELECT * FROM Users WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the username exists in the database
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['Password'])) {
        // Password is correct, redirect to home page or wherever you want
        header("Location: home.html");
        exit();
    } else {
        // Password is incorrect
        echo "Incorrect password. Please try again or <a href='login.html'>go back to login page</a>.";
    }
} else {
    // Username not found
    echo "User not found. Please <a href='login_form.html'>go back to login page</a> and try again.";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>