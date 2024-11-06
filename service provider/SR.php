<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Retrieve form data
    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $message = $_GET['message'];
    $status = "request"; // Assuming status is always "request" for new messages
    $serviceproviderid = $_COOKIE['id']; // Change this to the actual service provider ID

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO work (serviceproviderid, customername, customer_email, customer_message, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $serviceproviderid, $fullname, $email, $message, $status);

    // Insert the data
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Message sent successfully!";
        // Redirect after 0.5 seconds
        echo '<script>
                setTimeout(function(){
                    window.location.href = "../customer/CHome.php";
                }, 500);
            </script>';
            setcookie("id", "", time() - 3600, "/");
    } else {
        // Error occurred
        echo "Error: Unable to send message. " . $conn->error;
    }


// Set the expiration time of the cookie to the past to delete it

?>

