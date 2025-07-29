<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? ''); 
    $mobile = htmlspecialchars(trim($_POST['mobile'] ?? ''));
    $address = htmlspecialchars(trim($_POST['address'] ?? ''));
    $city = htmlspecialchars(trim($_POST['city'] ?? ''));


    if (empty($username) || empty($email) || empty($password) || empty($mobile) || empty($address) || empty($city)) {
        echo "All fields are required.";
        exit;
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
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

    
    $stmt = $conn->prepare("INSERT INTO user (username, email, password, mobile, address, city) VALUES (?, ?, ?, ?, ?, ?)");
    
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    
    $stmt->bind_param("ssssss", $username, $email, $password, $mobile, $address, $city);

    
    if ($stmt->execute()) {
    
        echo "<script>location.replace('userlogin.html');</script>";
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    

    $stmt->close();
    $conn->close();
}
?>
