<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update status to "pending" for the specified ID
    $sql = "UPDATE work SET status='pending' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "ID parameter is missing";
}

$conn->close();
?>
