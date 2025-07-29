<?php
$servername = "localhost"; 
$username = "root";        
$password = "";           
$dbname = "business"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $id_card = $_POST['id_card'];

    
    $sql = "INSERT INTO business_reg (username, email, password, mobile, address, city, id_card) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $username, $email, $password, $mobile, $address, $city, $id_card);


    if ($stmt->execute()) {
        header('Location: businesslogin.html'); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $stmt->close();
    $conn->close();
}
?>
