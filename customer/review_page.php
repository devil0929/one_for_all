<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall"; // Change this to your actual database name

// Fetch customer ID from session
$customer_id = $_SESSION['id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $place_id = $_GET['id']; // Get place_id from URL parameter
    $rating = $_POST['rating'];
    $review = $conn->real_escape_string($_POST['review']); // Escape special characters

    // Check if the customer has already reviewed the place
    $check_review_query = "SELECT * FROM placereview WHERE place_id = $place_id AND customer_id = $customer_id";
    $check_result = $conn->query($check_review_query);

    if ($check_result->num_rows > 0) {
        // If the customer has already reviewed the place, display a message
        echo '<script>alert("You have already reviewed this place.");window.location.href = "chome.php";</script>';
       
    } else {
        // Insert review into place_review table
        $insert_query = "INSERT INTO placereview (place_id, customer_id, rating, review) VALUES ($place_id, $customer_id, $rating, '$review')";

        if ($conn->query($insert_query) === TRUE) {
            // Update total_users_rated and rating in place_info table
            $update_query = "UPDATE place_info SET total_users_rated = total_users_rated + 1, rating = (rating * total_users_rated + $rating) / (total_users_rated) WHERE id = $place_id";

            if ($conn->query($update_query) === TRUE) {
                echo '<script>alert("Review submitted successfully!");</script>';
                echo '<script>alert("Place rating updated successfully!");</script>';
                
            } else {
                echo '<script>alert("Error updating place rating: ' . $conn->error . '");</script>';
                
            }
        } else {
            echo '<script>alert("Error submitting review: ' . $conn->error . '");</script>';
            
        }
    }

    // Close database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        
        form {
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        label {
            font-weight: bold;
            color: #555;
        }
        
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        textarea {
            resize: vertical;
            height: 100px;
        }
        
        input[type="submit"] {
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
        }
        
        input[type="submit"]:hover {
            background-color: #008000;
        }
        
        button {
            background-color: green;
            border: 1px solid white;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-right: 10px;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $_GET['id']; ?>" method="post">
        <h2>Submit a Review</h2>
        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required><br>
        <label for="review">Review:</label><br>
        <textarea name="review" id="review" cols="30" rows="5" required></textarea><br>
        <button type="submit">Submit Review</button>
    </form>
</body>

</html>
