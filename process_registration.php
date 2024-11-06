<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set parameters
$name = $_POST["name"];
$rating = $_POST["rating"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$category = $_POST["category"];
$services = $_POST["services"];
$description = $_POST["description"];
$start_time = $_POST["start_time"];
$close_time = $_POST["close_time"];
$year_of_starting_business = $_POST["year_of_starting_business"];
$city = $_POST["city"];
$total_rating = $_POST["total_rating"];
$total_users_rated = $_POST["total_users_rated"];
$filename = isset($_FILES["main_photo"]) ? $_FILES["main_photo"]["name"] : null; // Check if file is uploaded
$folder = "./Photos/" . $filename;

// Check if a file was uploaded
if ($filename !== null) {
    $tempname = $_FILES["main_photo"]["tmp_name"];
    // Move uploaded file to destination folder
    if (move_uploaded_file($tempname, $folder)) {
        echo "File uploaded successfully";
    } else {
        echo "Error uploading file";
    }
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO place_info (name, rating, address, phone, catagory, services, description, start_time, close_time, year_of_starting_business, city, total_rating, total_users_rated, main_photo) VALUES ('".$name."','". $rating."','".$address."','". $phone."','". $category."','". $services."','". $description."','". $start_time."','". $close_time."','". $year_of_starting_business."','". $city."','". $total_rating."','". $total_users_rated."','". $filename."')");

// Bind parameters

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: customer/CHome.php");
    exit(); 
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
