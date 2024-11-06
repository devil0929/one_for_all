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

        .hospital-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .hospital-container {
            display: flex;
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

        .hospital-details {
            flex: 1; /* Take up remaining space */
            padding: 10px;
        }

        .hospital-details h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .hospital-details p {
            margin-bottom: 10px;
        }

        .btn-enquire {
            background-color: green;
            border: 1px solid white;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-right: 10px;
            border-radius: 5px;
        }

        .btn-enquire:hover {
            background-color: darkgreen;
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
    <!-- Search Bar and Sorting Options -->
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search by hospital name" oninput="filterHospitals()">
    </div>

    <div class="content-container">
        <!-- Hospital List -->
        <div class="hospital-list" id="hospitalList">
            <!-- Hospitals will be dynamically added here -->
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
                    // Retrieve hospital ID from POST data
                    $id = $_POST['id'];

                    // Update request_status to 1 for the given hospital ID
                    $sql = "UPDATE place_info SET request_status=1 WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Status updated successfully');</script>";
                    } else {
                        echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
                    }
                } else {
                    echo "<script>alert('ID not provided');</script>";
                }
            }

            // SQL query to fetch data from place_info table
            $sql = "SELECT * FROM place_info WHERE request_status=0";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="hospital-container">';
                    echo '<img class="imgcl" src="Photos/' . $row["main_photo"] . '" alt="' . $row["name"] . '">';

                    echo '<div class="hospital-details">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["services"] . '</p>';
                    echo '<div class="rating-stars">' . generateStars($row["rating"]) . '(' . $row["total_users_rated"] . ')</div>';
                    echo '<p>Category: ' . $row["category"] . '</p>';
                    echo '<p>Address: ' . $row["address"] . '</p>';
                    echo '<p>Phone: ' . $row["phone"] . '</p>';

                    // Button for inquiry
                    echo '<a href="https://api.whatsapp.com/send?phone=' . $row["phone"] . '" class="btn-enquire" style="background-color: green; border: 1px solid white; color: white; padding: 10px; text-decoration: none; margin-right: 10px;" target="_blank">contect</a>';
                    
                    // Button to change request status
                    echo '<form method="post" style="display: inline;">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn-change-status" style="background-color: #007bff; border: 1px solid white; color: white; padding: 10px; text-decoration: none; margin-right: 10px;">Accept Request</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            // Function to generate star ratings
            function generateStars($rating)
            {
                $roundedRating = round($rating * 2) / 2; // Round to nearest 0.5
                $stars = array_fill(0, 5, false);
                for ($i = 0; $i < $roundedRating; $i++) {
                    $stars[$i] = true;
                }
                $starHtml = "";
                foreach ($stars as $hasStar) {
                    $starHtml .= $hasStar ? '★' : '☆';
                }
                return $starHtml;
            }
            ?>
        </div>
    </div>
</main>

<footer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <div class="footer">
        <div class="row">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
        </div>

        <div class="row">
            <ul>
                <li><a href="../contactus.php">Contact us</a></li>
                <li><a href="../Privacy Policy.html">Privacy Policy</a></li>
                <li><a href="../Terms & Conditions.html">Terms & Conditions</a></li>
                <li><a href="../career.php">Career</a></li>
            </ul>
        </div>

        <div class="row">
            Oneforall Copyright © 2024 - All rights reserved || Designed By: Dev and Sandhya
        </div>
    </div>
</footer>

<script>
    // Function to filter hospitals based on input text
    function filterHospitals() {
        var input, filter, hospitalList, hospitals, name, i, txtValue;
        input = document.querySelector('.search-input');
        filter = input.value.toUpperCase();
        hospitalList = document.getElementById('hospitalList');
        hospitals = hospitalList.getElementsByClassName('hospital-container');

        for (i = 0; i < hospitals.length; i++) {
            name = hospitals[i].getElementsByClassName('hospital-details')[0].getElementsByTagName('h2')[0];
            txtValue = name.textContent || name.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                hospitals[i].style.display = "";
            } else {
                hospitals[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>
