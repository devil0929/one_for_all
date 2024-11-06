<?php
$_COOKIE['catagory']="electronics";
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
    </style>

</head>

<body>
    
        <header class="page_header relative">
            <div class="navbar">
                <div class="navbar_header">
                    <a class="navbar_brand" data-logo="AllForOne" href="/"><span class="brand_logo"><span class="hide">OneForAll</span></span></a><button class="navbar_opener"><span></span><span></span><span></span><span></span></button>
                </div>
                <div class="navbar_menu">
                    <nav class="menu" data-reactid="16">
                        <ul class="menu_list menu_list-main" data-reactid="17">
                            <li class="menu_item menu_item-big" data-reactid="18">
                                <a class="menu_link menu_link-anim" href="/about" data-reactid="19">
                                    <span class="link_layer" data-text="About Us" data-reactid="20"></span>About Us
                                </a>
                            </li>
                            <li class="menu_item menu_item-big" data-reactid="22">
                                <a class="menu_link menu_link-anim" href="/services" data-reactid="23">
                                    <span class="link_layer" data-text="Services" data-reactid="24"></span>Services
                                </a>
                            </li>
                            <li class="menu_item menu_item-big" data-reactid="26">
                                <a class="menu_link menu_link-anim" href="/our-work" data-reactid="27">
                                    <span class="link_layer" data-text="Our Work" data-reactid="28"></span>Our
                                </a>
                            </li>
                            <li class="menu_item menu_item-big" data-reactid="30">
                                <a class="menu_link menu_link-anim" href="/careers" data-reactid="31">
                                    <span class="link_layer" data-text="Careers" data-reactid="32"></span>Careers
                                </a>
                            </li>
                            <li class="menu_item menu_item-big" data-reactid="34">
                                <a class="menu_link menu_link-anim" href="/contact" data-reactid="35">
                                    <span class="link_layer" data-text="Contact Us" data-reactid="36"></span>Contact Us
                                </a>
                            </li>
                        </ul>
                        <ul class="menu_list menu_list-alter" data-reactid="38">
                            <li class="menu_item" data-reactid="39">
                                <a class="menu_link" href="/blog" data-reactid="40">
                                    <span class="link_layer" data-text="Blog" data-reactid="41"></span>Blog
                                </a>
                            </li>
                            <li class="menu_item" data-reactid="43">
                                <a class="menu_link" href="/events" data-reactid="44">
                                    <span class="link_layer" data-text="Events" data-reactid="45"></span>Events
                                </a>
                            </li>
                            <li class="menu_item" data-reactid="47">
                                <a class="menu_link" href="/academy" data-reactid="48">
                                    <span class="link_layer" data-text="Training and Workshops" data-reactid="49"></span>Workshops
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

        </header>
    
    

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
            $sql = "SELECT * FROM place_info WHERE catagory='" . $_COOKIE['catagory'] . "'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="hospital-container">';
                    echo '<img class="imgcl" src="Photos/login/bg2.jpg" alt="' . $row["name"] . '">';
                    echo '<div class="hospital-details">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["services"] . '</p>';
                    echo '<div class="rating-stars">' . generateStars($row["rating"]) . '</div>';
                    echo '<p>Address: ' . $row["address"] . '</p>';
                    echo '<p>Phone: ' . $row["phone"] . '</p>';
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
        <!-- Ad Container -->
        <div class="ad-container">
            <!-- Ad images will be added here -->
            <img class="ad-img" src="Photos/login/bg2.jpg" alt="Ad 1">
            <img class="ad-img" src="path/to/ad2.jpg" alt="Ad 2">
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