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
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobile_number'];
    $eventCategory = $_POST['event_category'];
    $eventLocation = $_POST['event_location'];

    
    if (!empty($_FILES["poster"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["poster"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
        if ($_FILES["poster"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        
        } else {
            if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
                
                $stmt = $conn->prepare("INSERT INTO create_event (event_name, event_date, email, mobile_number, event_category, event_location, poster) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $eventName, $eventDate, $email, $mobileNumber, $eventCategory, $eventLocation, $target_file);

                if ($stmt->execute() === TRUE) {
                    echo "Event created successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }

    $conn->close();
}
?>
