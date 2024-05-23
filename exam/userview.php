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

// Fetch all data from users table
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handmade - View Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-links a {
            margin-right: 10px;
            color: #5cb85c;
            text-decoration: none;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        footer {
            height: 50px;
            text-align: center;
            padding: 25px;
            color: white;
            background-color: blue;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="./home.html">Home</a>
        <a href="./about.html">About</a>
        <a href="./register.html">Add user</a>
        <a href="./contact.html">Contact</a>
    </div>

    <div class="container">
        <h1>View Users</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='bg-warning'>";
            echo "<tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Action</th>
                  </tr>";
            echo "</thead><tbody>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['names']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telephone']}</td>
                        <td class='action-links'>
                            <a href='userupdate.php?id={$row['user_id']}'>Update</a>
                            <a href='userdelete.php?id={$row['user_id']}' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No users found</p>";
        }
        $conn->close();
        ?>
    </div>

    <footer>
        <p>&copy; &reg; 2024 UR CBE BIT YEAR 2 @ Group C</p>
    </footer>
</body>
</html>
