<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    
    if (empty($username) || empty($password)) {
        echo "Both username and password are required.";
        exit;
    }

    
    $host = 'localhost'; 
    $dbUsername = 'root'; 
    $dbPassword = ''; 
    $dbName = 'user_registration'; 

    
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows > 0) {
        
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

    
        if ($password === $storedPassword) {
        
            echo "<script>location.replace('userhomepage.html');</script>";
        } else {
            
            echo "Invalid username or password.";
        }
    } else {
    
        echo "Invalid username or password.";
    }

    
    $stmt->close();
    $conn->close();
}
?>
