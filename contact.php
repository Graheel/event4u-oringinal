<?php
$servername = "localhost:3306"; 
$username = "root"; 
$password = ""; 
$database = "graheel"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    
    $stmt = $conn->prepare("INSERT INTO contact(name, phone, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $email, $message);

    
    if ($stmt->execute() === TRUE) {
        header("Location: index.html");
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>