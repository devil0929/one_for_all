<?php
// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];
     setcookie("id", $id, time() + (86400 * 30), "/"); 
    // Now you can use the $id variable to perform further operations
  
} else {
    // Handle the case when the ID parameter is not set
    echo "ID parameter not found in the URL";
    
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
        }
        
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        
        form {
            max-width: 500px;
            margin: 20px auto;
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
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Write a Review</h1>
    <form action="insert_review.php" method="POST">
        <label for="customer_name">Your Name:</label><br>
        <input type="text" id="customer_name" name="customer_name" required><br><br>

        <label for="review">Your Review:</label><br>
        <input type="text" id="review" name="review" rows="4" cols="50" required></input><br><br>

        <label for="rating">Rating (1-5):</label><br>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
