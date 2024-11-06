<?php
$x = $_GET['catagory'];
$_COOKIE['catagory'] = $x;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Home/master.css" />
    <link rel="stylesheet" href="CSS/Customerpages/contant.css" />




    <link rel="stylesheet" href="CSS/Home/footer.css" />
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: black;
        }
        .ad-container {
        display: grid;
        grid-template-columns: 1fr; /* Each ad occupies one full column */
        grid-gap: 20px; /* Adjust gap between grid items */
    }

    .ad-item {
        border-radius: 5px;
        overflow: hidden;
    }

    .ad-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .ad-description {
        margin-top: 10px; /* Adjust margin as needed */
    }
   </style>

</head>

<body>




    <h1 class="headplace"><?php echo $_COOKIE['catagory'] ?></h1>


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

            // SQL query to fetch data from place_info table
            $sql = "SELECT * FROM place_info WHERE category='" . $_COOKIE['catagory'] . "' AND request_status=1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                // Output data of each row
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="hospital-container">';
                    echo '<img class="imgcl" src="../Photos/' . $row["main_photo"] . '" alt="' . $row["name"] . '">';

                    echo '<div class="hospital-details">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["services"] . '</p>';
                    echo '<div class="rating-stars">' . generateStars($row["rating"]) . '('.$row["total_users_rated"].')</div>';
                    echo '<p>Address: ' . $row["address"] . '</p>';
                    echo '<p>Phone: ' . $row["phone"] . '</p>';

                    // Button for inquiry
                    echo '<a href="tel:' . $row["phone"] . '" class="btn-enquire" style="background-color: green; border: 1px solid white; color: white; padding: 10px; text-decoration: none; margin-right: 10px;" target="_blank">Inquire</a>';

                    // Button for giving reviews
                    echo '<a href="review_page.php?id=' . $row["id"] . '" class="btn-review" style="background-color: green; border: 1px solid white; color: white; padding: 10px; text-decoration: none;">Give Review</a>';

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
      
<div class="ad-container">
    <?php
    // Establish database connection (Assuming you have already established a connection)
    $conn = new mysqli("localhost", "root", "", "oneforall");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch three random ads with descriptions
    $sql = "SELECT ad_photo, ad_description, ad_onclick_link FROM Ads WHERE ad_status = 1 ORDER BY RAND() LIMIT 3";

    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display ad item
            echo '<a href="'.$row["ad_onclick_link"].'">';
            echo '<div class="ad-item">';
            // Display ad image
            echo '<img class="ad-img" src="../Photos/' . $row["ad_photo"] . '" alt="Ad">';
            // Display ad description
            echo '<p class="ad-description">' . $row["ad_description"] . '</p>';
            echo '</div>';
            echo '</a>';
        }
    } else {
        echo "No ads found";
    }

    // Close connection
    $conn->close();
    ?>
</div>

    </div>



    <!--footer section -->


    <footer>
        <div class="footer">
            <div class="row">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </div>

            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="Privacy Policy.html">Privacy Policy</a></li>
                    <li><a href="Terms & Conditions.html">Terms & Conditions</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>

            <div class="row">
                Oneforall Copyright © 2024 - All rights reserved || Designed By: Dev And Sandhy
            </div>
        </div>
    </footer>
    <!-- Script for contant -->
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


        // Initial sorting
        sortHospitals();
    </script>








    <script src="Script/Sdashbord/unknow.js"></script>
    <script>
        $('.navbar_opener').on('click', () => {
            $('.navbar').toggleClass('navbar-opened')
        })
    </script>
    <script>
        var text = document.getElementById('textc');
        var newDom = '';
        var animationDelay = 6;

        for (let i = 0; i < text.innerText.length; i++) {
            newDom += '<span class="char">' + (textc.innerText[i] == ' ' ? '&nbsp;' : textc.innerText[i]) + '</span>';
        }

        text.innerHTML = newDom;
        var length = textc.children.length;

        for (let i = 0; i < length; i++) {
            textc.children[i].style['animation-delay'] = animationDelay * i + 'ms';
        }
    </script>
    <script>
        var text = document.getElementById('textm');
        var newDom = '';
        var animationDelay = 6;

        for (let i = 0; i < text.innerText.length; i++) {
            newDom += '<span class="charm">' + (textm.innerText[i] == ' ' ? '&nbsp;' : textm.innerText[i]) + '</span>';
        }

        textm.innerHTML = newDom;
        var length = textm.children.length;

        for (let i = 0; i < length; i++) {
            textm.children[i].style['animation-delay'] = animationDelay * i + 'ms';
        }
    </script>


</body>

</html>