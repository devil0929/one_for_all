<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS/Home/footer.css" />
    <style>
        /* Reset some default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: black; /* Dark background */
            color: #fff; /* White text */
            font-family: Arial, sans-serif;
        }

        .admin-header {
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .admin-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-nav ul li {
            display: inline-block;
            margin-left: 20px;
        }

        .admin-nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        body {
            background-color: black; /* Dark background */
            color: #fff; /* White text */
            font-family: Arial, sans-serif;
            padding: 20px; /* Add padding to the body */
        }

        .main-content {
            background-color:black; /* Dark background for the content */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Add padding to the main content */
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            width: 100%;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }

        .ads-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .ad-container {
            width: calc(50% - 10px); /* Adjust width to fit two items in a row with margin */
            margin-bottom: 20px;
            background-color: #222;
            color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }

        .imgcl {
            width: 150px; /* Set fixed width for the photo */
            height: auto;
            margin-right: 20px; /* Add margin to separate the photo from the information */
            border-radius: 5px 0 0 5px; /* Rounded corners for the left side */
        }

        .ad-details {
            padding: 10px;
        }

        .ad-details h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .ad-details p {
            margin-bottom: 10px;
        }

        .btn-remove {
            background-color: #007bff;
            border: 1px solid white;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-right: 10px;
            border-radius: 5px;
        }

        .btn-remove:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<header class="admin-header">
    <div class="logo">OneForAll</div>
    <nav class="admin-nav">
        <ul>
            <li><a href="Dadmin.php">Business Registration Requests</a></li>
            <li><a href="Dadmin2.php">Register Business</a></li>
            <li><a href="ad_re.php">Ads Requests</a></li>
            <li><a href="ad_re2.php">Available Ads</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Add more options here as needed -->
        </ul>
    </nav>
</header>

<main class="main-content">
    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search by ad title" oninput="filterAds()">
    </div>

    <div class="ads-list" id="adsList">
        <!-- Ads will be dynamically added here -->
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

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if ID is set and not empty
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                // Retrieve ad ID from POST data
                $id = $_POST['id'];

                // Update ad_status to 0 for the given ad ID
                $sql = "UPDATE ads SET ad_status=0 WHERE ad_id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Status updated successfully');</script>";
                } else {
                    echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('ID not provided');</script>";
            }
        }

        // SQL query to fetch data from ads table and join it with customer table
        $sql = "SELECT a.ad_id, a.ad_title, a.ad_description, a.ad_photo, c.full_name
        FROM ads a 
        INNER JOIN customer c ON a.advertiser_id = c.id
        WHERE a.ad_status = 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="ad-container">';
                echo '<img class="imgcl" src="Photos/' . $row["ad_photo"] . '" alt="' . $row["ad_title"] . '">';

                echo '<div class="ad-details">';
                echo '<h2>' . $row["ad_title"] . '</h2>';
                echo '<p>' . $row["ad_description"] . '</p>';
                echo '<p>Advertiser: ' . $row["full_name"] . '</p>';

                // Form for Remove button
                echo '<form method="post" style="display: inline;">';
                echo '<input type="hidden" name="id" value="' . $row["ad_id"] . '">';
                echo '<button type="submit" class="btn-remove">Remove</button>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</main>

<script>
    // Function to filter ads based on input text
    function filterAds() {
        var input, filter, adsList, ads, title, i, txtValue;
        input = document.querySelector('.search-input');
        filter = input.value.toUpperCase();
        adsList = document.getElementById('adsList');
        ads = adsList.getElementsByClassName('ad-container');

        for (i = 0; i < ads.length; i++) {
            title = ads[i].getElementsByClassName('ad-details')[0].getElementsByTagName('h2')[0];
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                ads[i].style.display = "";
            } else {
                ads[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>
