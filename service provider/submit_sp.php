<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "oneforall";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $service_provider_title = $_POST["service-provider-title"];
    $full_name = $_POST["full-name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $birthday = $_POST["birthday"];
    $location = $_POST["location"];
    
    $instagram = $_POST["social-links-for-instagram"];
    $facebook = $_POST["social-links-for-facebook"];
    $twitter = $_POST["social-links-for-twitter"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $about_me = $_POST["about-me"];
    $filename = $_FILES["service-provider-image"]["name"]; // Corrected to use $_FILES
    $tempname = $_FILES["service-provider-image"]["tmp_name"]; // Corrected to use $_FILES
    $folder = "./Photos/" . $filename;
    
    if (move_uploaded_file($tempname, $folder)) {
        echo "success"; // Corrected spelling
    } else {
        echo "error";
    }
    
   
// Insert data into service_providers table
$stmt_provider = $conn->prepare("INSERT INTO service_providers (service_provider_title, service_provider_image, full_name, email, phone, birthday, location, instagram, facebook, twitter, username, password, about_me) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Check if the prepare() succeeded
if ($stmt_provider) {
    // Bind parameters
    $stmt_provider->bind_param("sssssssssssss", $service_provider_title, $filename, $full_name, $email, $phone, $birthday, $location, $instagram, $facebook, $twitter, $username, $password, $about_me);


    // Execute statement
    $stmt_provider->execute();

    // Close statement
    $stmt_provider->close();
} else {
    // Handle error if prepare() failed
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

    // Get the ID of the inserted service provider
    $provider_id = $conn->insert_id;

    // Insert services into the services table
    if (isset($_POST["service-title"]) && isset($_POST["service-description"])) {
        $service_titles = $_POST["service-title"];
        $service_descriptions = $_POST["service-description"];

        // Prepare and bind SQL statement for inserting services
        $stmt_service = $conn->prepare("INSERT INTO services (provider_id, service_title, service_description) VALUES (?, ?, ?)");
        $stmt_service->bind_param("iss", $provider_id, $service_title, $service_description);

        // Insert each service
        for ($i = 0; $i < count($service_titles); $i++) {
            $service_title = $service_titles[$i];
            $service_description = $service_descriptions[$i];

            // Execute the prepared statement
            $stmt_service->execute();
        }

        // Close the prepared statement
        $stmt_service->close();
    }

    // Close the database connection
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Redirect After Success Message</title>
</head>
<body>
<div id="successMessage" style="display: none;">
  <p>Success! Redirecting...</p>
</div>

<script>
// Function to display success message and redirect after 1 second
function displaySuccessAndRedirect() {
  var successMessage = document.getElementById('successMessage');
  successMessage.style.display = 'block';
  setTimeout(function() {
    window.location.href = '../slogin.php'; // Replace 'https://example.com' with your desired URL
  }, 1000); // 1000 milliseconds = 1 second
}

// Call the function when the page loads (for demonstration purposes)
window.onload = function() {
  displaySuccessAndRedirect();
};
</script>
</body>
</html>
