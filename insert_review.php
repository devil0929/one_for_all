<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall"; // Change this to your actual database name
$id = $_COOKIE['id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the work table where id = 1
$sql_work = "SELECT serviceproviderid FROM work WHERE id =".$id;
$result_work = $conn->query($sql_work);

if ($result_work->num_rows > 0) {
    // Retrieve the first row (assuming id is unique)
    $row_work = $result_work->fetch_assoc();
    $service_provider_id = $row_work["serviceproviderid"];
    $customer_id = 1;

    // Retrieve form data
    $customer_name = $_POST['customer_name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // Insert data into the database
    $sql_insert = "INSERT INTO reviews (service_provider_id, customer_id, customer_name, review, rating) 
                   VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("iisis", $service_provider_id, $customer_id, $customer_name, $review, $rating);

    if ($stmt->execute()) {
        echo "Review submitted successfully!";
        
        // Update status to 'completed' in the work table
        $sql_update = "UPDATE work SET status = 'completed', completed_at = NOW() WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $id);

        if ($stmt_update->execute()) {
            echo "Status updated to 'completed' successfully!";

        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
} else {
    echo "No data found in the work table for id =".$id;
}

// Close connection
$conn->close();
?>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall"; // Change this to your actual database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total_customer_rated and total_rating from the service_providers table
$sql_fetch = "SELECT total_customer_rated, total_rating FROM service_providers WHERE id = ?";
$stmt_fetch = $conn->prepare($sql_fetch);
// Change this to the actual id of the service provider
$stmt_fetch->bind_param("i", $id);
$stmt_fetch->execute();
$stmt_fetch->bind_result($total_customer_rated, $total_rating);
$stmt_fetch->fetch();

// Close the result set
$stmt_fetch->close();

// Calculate new values
$new_total_customer_rated = $total_customer_rated + 1;
$new_total_rating = (($total_rating * $total_customer_rated) + $rating) / $new_total_customer_rated;

// Update total_customer_rated and total_rating in the service_providers table
$sql_update = "UPDATE service_providers SET total_customer_rated = ?, total_rating = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("iii", $new_total_customer_rated, $new_total_rating, $id);
$stmt_update->execute();

// Check if the update was successful
if ($stmt_update->affected_rows > 0) {
    echo "Total customers rated and total rating updated successfully!";
    header("Location: customer/CHome.php");
    exit(); 
} else {
    echo "Error updating total customers rated and total rating: " . $conn->error;
}

// Close connection
$conn->close();
?>
