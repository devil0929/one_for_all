<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user credentials against the database
    $servername = "localhost";
    $dbname= "oneforall";
    $dbusername = "root";
    $dbpassword= "";
    
    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input data to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password for comparison
   

    // Query the database to validate the user
    $sql = "SELECT * FROM customer WHERE email='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if ($password==$row['password']) {
            // Successful login
            echo "Login successful!";
            $_SESSION["id"] = $row['id'];
            $_SESSION["username"] = $row['email'];
            header("Location: customer/CHome.php");
            exit(); 
        } else {
            // Invalid password
            echo " $password";
            echo "Invalid password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your username.";
    }

    // Close the database connection
    $conn->close();
}
?>
