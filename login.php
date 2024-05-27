<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projek_web";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve the input
    $user_name = $conn->real_escape_string($_POST['username']);
    $password = md5($conn->real_escape_string($_POST['password'])); // Hash the password with MD5

    // Check the credentials
    $sql = "SELECT * FROM users WHERE username='$user_name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login successful!";
        
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
