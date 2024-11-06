<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #222;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="time"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #555;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333;
            color: #fff;
        }

        label {
            font-weight: bold;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Place Registration</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="">Select a category</option>
            <option value="Daily_needs">Daily needs</option>
            <option value="Hotels">Hotels & Restaurant</option>
            <option value="Flight">Travel & Flight</option>
            <option value="Electricians">Electricians</option>
            <option value="GYM">GYM</option>
            <option value="Hospital">Hospital</option>
            <option value="Beauty">Beauty</option>
            <option value="Hospital">Hospital</option>
            <option value="Beauty">Beauty</option>
        </select><br>

        <label for="services">Services:</label>
        <input type="text" id="services" name="services"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time"><br>

        <label for="close_time">Close Time:</label>
        <input type="time" id="close_time" name="close_time"><br>

        <label for="year_of_starting_business">Year of Starting Business:</label>
        <input type="number" id="year_of_starting_business" name="year_of_starting_business"><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city"><br>

        <label for="main_photo">Main Photo:</label>
        <input type="file" id="main_photo" name="main_photo" accept="image/*"><br>

        <input type="submit" value="Submit">
    </form>

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

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set parameters
        $name = $_POST["name"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $category = $_POST["category"];
        $services = $_POST["services"];
        $description = $_POST["description"];
        $start_time = $_POST["start_time"];
        $close_time = $_POST["close_time"];
        $year_of_starting_business = $_POST["year_of_starting_business"];
        $city = $_POST["city"];
        $filename = isset($_FILES["main_photo"]) ? $_FILES["main_photo"]["name"] : null; // Check if file is uploaded
        $folder = "./Photos/" . $filename;

        // Check if a file was uploaded
        if ($filename !== null) {
            $tempname = $_FILES["main_photo"]["tmp_name"];
            // Move uploaded file to destination folder
            if (move_uploaded_file($tempname, $folder)) {
                $message = "File uploaded successfully";
            } else {
                $message = "Error uploading file";
            }
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO place_info (name, address, phone, category, services, description, start_time, close_time, year_of_starting_business, city, main_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssssssssss", $name, $address, $phone, $category, $services, $description, $start_time, $close_time, $year_of_starting_business, $city, $filename);

        // Execute the prepared statement
        if ($stmt->execute()) {
            $message = "New record created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <script>
        <?php
        // Display message in a pop-up window
        if (isset($message)) {
        ?>
            alert("<?php echo $message; ?>");
            window.location.href = "customer/CHome.php";
        <?php
        }
        ?>
    </script>

</body>

</html>
