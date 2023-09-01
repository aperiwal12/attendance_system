<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "a";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve input data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the user exists in the database
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // User exists, mark attendance
    $user_id = $result->fetch_assoc()['id'];
    $attendance_date = date("Y-m-d H:i:s"); // Current date and time

    $insert_query = "INSERT INTO attendance (user_id, attendance_date) VALUES ('$user_id', '$attendance_date')";
    if ($conn->query($insert_query) === TRUE) {
        // Attendance marked successfully
        echo "<script>alert('Attendance marked successfully');</script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
} else {
    echo "<script>alert('Invalid email or password');</script>";
}

// Close database connection
$conn->close();
?>
