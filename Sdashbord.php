<?php
// Start the session
session_start();

// Set session variables
$su = $_SESSION["un"];

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oneforall";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch service provider from the database
$sql = "SELECT * FROM service_providers WHERE id='$su'";
$result_reviews = $conn->query($sql);
if ($result_reviews->num_rows > 0) {
    while ($row = $result_reviews->fetch_assoc()) {
        $sid = $row["id"];
        $title = $row['service_provider_title'];
        $profileImage = $row['service_provider_image'];
        $name = $row["full_name"];
    }
} else {
    echo "No records found for the username: $su";
}

// Close the database connection
$conn->close();
?>


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <link rel="stylesheet" href="CSS/Service/dashbord/style.css" />
    <style>
        /* Table styling */
        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid white;
            /* Set border color to white */
        }



        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: white;
            /* Set text color to white */
            text-align: left;
            /* Align text to the left */
        }

        /* Alternate row background color */

        /* Button styling */
        button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Table section heading */
        .Wheading {
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
            /* Set text color to white */
        }

        h4 {
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="profile">
                <div class="logo">
                    <img src="images/logo-icon.svg" alt="Logo" />
                    <span class="logo-txt">OneForAll</span>
                </div>
                <img src="./service provider/Photos/<?php echo $profileImage; ?>" alt="Logo" class="profile-img" />
                <div class="profile-content">
                    <h2 class="name text-white"><?php echo $name; ?></h2>
                    <span class="position text-dark"><?php echo $title; ?></span>
                </div>
            </div>

            <ul class="menu">
                <li class="list active">
                    <a href="#dashboard" class="link">
                        <img src="images/icon-01.svg" alt="icon" />
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#teams" class="link">
                        <img src="images/icon-02.svg" alt="icon" />
                        <span>Work Requests</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#payments" class="link">
                        <img style="width:24px; height:24px;" src="images/pending.png" alt="icon" />
                        <span>Pending</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#attendance" class="link">
                        <img src="images/icon-04.svg" alt="icon" />
                        <span>Completed Work</span>
                    </a>
                </li>
                <li class="list">
                    <a href="editsp.php" style="color: white; text-align:center">
                        <img src="images/icon-05.svg" alt="icon" />
                        <span>edit profile</span>
                    </a>
                </li>

            </ul>


        </div>
        <div class="content">
            <section id="dashboard">

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

                // Fetch customer reviews and ratings
                $sql_reviews = "SELECT customer_id, customer_name, review, rating FROM reviews where service_provider_id=" . $sid;
                $result_reviews = $conn->query($sql_reviews);

                if ($result_reviews->num_rows > 0) {
                    echo "<table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Review</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>";
                    // Output data of each row
                    while ($row = $result_reviews->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["customer_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["review"] . "</td>";
                        echo "<td>" . $row["rating"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo '<h4>No reviews found</h4>';
                }

                // Close connection
                $conn->close();
                ?>


            </section>
            <section id="teams">

                
                        <?php
                        // Connect to the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "oneforall";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from the work table with status="request"
                        $sql = "SELECT id,customername, customer_email, customer_message, status, created_at FROM work WHERE status='request' AND serviceproviderid=" . $sid;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<table>
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th> <!-- Added Action column -->
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["customername"] . "</td>";
                                echo "<td>" . $row["customer_email"] . "</td>";
                                echo "<td>" . $row["customer_message"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td><button onclick=\"acceptRequest(" . $row["id"] . ")\">Accept</button></td>"; // Add Accept button
                                echo "</tr>";
                            }
                        } else {
                            echo "<h4>No work requests found</h4>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
            <section id="payments">

               
                        <?php
                        // Connect to the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "oneforall";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from the work table with status="request"
                        $sql = "SELECT id,customername, customer_email, customer_message, status, created_at FROM work WHERE status='pending' AND serviceproviderid=" . $sid;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo " <table>
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <!-- Added Action column -->
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["customername"] . "</td>";
                                echo "<td>" . $row["customer_email"] . "</td>";
                                echo "<td>" . $row["customer_message"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<h4>No work requests found</h4>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
            <section id="attendance">
                
                        <?php
                        // Connect to the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "oneforall";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from the work table
                        $sql = "SELECT * FROM work where status='completed'AND serviceproviderid=" . $sid;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<table>
                            <thead>
                                <tr>
        
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Completed At</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";

                                echo "<td>" . $row["customername"] . "</td>";
                                echo "<td>" . $row["customer_email"] . "</td>";
                                echo "<td>" . $row["customer_message"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td>" . $row["completed_at"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<h4>No data found</h4>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <script src="Script/Sdashbord/script.js"></script>
    <script>
        function acceptRequest(id) {
            // Send AJAX request to update status to "pending" in the database
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page or update the table
                    location.reload(); // Reload the page after accepting the request
                }
            };
            xhttp.open("GET", "update_status.php?id=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>