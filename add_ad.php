<?php
session_start(); // Start the session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection (Assuming you have already established a connection)
    $conn = new mysqli("localhost", "root", "", "oneforall");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from form submission
    $ad_title = $_POST['ad_title'];
    $ad_description = $_POST['ad_description'];
    $advertiser_id = isset($_SESSION['id']) ? $_SESSION['id'] : ''; // Retrieve advertiser ID from session
    $ad_posted_date = date('Y-m-d'); // Generate current date
    $onclicklink = $_POST['ad_onclick_link'];

    // Handle file upload
    $filename = isset($_FILES["ad_photo"]) ? $_FILES["ad_photo"]["name"] : null; // Check if file is uploaded
    $folder = "./Photos/" . $filename;

    // Check if a file was uploaded
    if ($filename !== null) {
        $tempname = $_FILES["ad_photo"]["tmp_name"];
        // Move uploaded file to destination folder
        if (move_uploaded_file($tempname, $folder)) {
            // Prepare SQL statement to insert data into Ads table
            $sql = "INSERT INTO Ads (ad_title, ad_description, ad_photo, advertiser_id, ad_posted_date,ad_onclick_link) VALUES (?, ?, ?, ?, ?,?)";

            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiss", $ad_title, $ad_description, $filename, $advertiser_id, $ad_posted_date,$onclicklink);

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                // Close statement
                $stmt->close();
                // Close connection
                $conn->close();
                // Show success message using JavaScript
                echo '<script>alert("Ad registered successfully!"); window.location = "customer/CHome.php";</script>';
                exit(); // Stop further execution
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "No file uploaded";
    }

    // Close statement
    $stmt->close();
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ad Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Ad Registration Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="ad_title">Ad Title:</label><br>
        <input type="text" id="ad_title" name="ad_title" required><br><br>
        
        <label for="ad_description">Ad Description:</label><br>
        <textarea id="ad_description" name="ad_description" required></textarea><br><br>
        
        <label for="ad_photo">Ad Photo:</label><br>
        <input type="file" id="ad_photo" name="ad_photo" accept="image/*" required><br><br>
        
        <!-- Ad OnClick Link -->
        <label for="ad_onclick_link">Ad OnClick Link:</label><br>
        <input type="text" id="ad_onclick_link" name="ad_onclick_link" required><br><br>
        
        <input type="submit" value="Register Ad">
    </form>
</body>
</html>
