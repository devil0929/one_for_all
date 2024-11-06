<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Home/master.css" />

    <link rel="stylesheet" href="CSS/Home/firstcard.css" />

    <link rel="stylesheet" href="CSS/Home/firstanimation.css" />
    <link rel="stylesheet" href="CSS/Home/footer.css" />
    <style>
        .search-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        #search {
            width: 80%;
            height: 20%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }

        #category-list {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            padding: 10px;
            justify-content: center;
            text-align: center;

        }

        .category {
            width: 30%;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
        }

        .category:hover {
            background-color: #444;
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
                       <a class="menu_link menu_link-anim" href="../aboutus.html" data-reactid="19">
                          <span class="link_layer" data-text="About Us" data-reactid="20"></span>About Us
                       </a>
                    </li>
                    <li class="menu_item menu_item-big" data-reactid="22">
                       <a class="menu_link menu_link-anim" href="servicelist.php"   data-reactid="23">
                          <span class="link_layer" data-text="Services" data-reactid="24"></span>Repair 
                       </a>
                    </li>
                    
                    <li class="menu_item menu_item-big" data-reactid="30">
                       <a class="menu_link menu_link-anim" href="../career.php" data-reactid="31">
                          <span class="link_layer" data-text="Careers" data-reactid="32"></span>Careers
                       </a>
                    </li>
                    <li class="menu_item menu_item-big" data-reactid="34">
                       <a class="menu_link menu_link-anim" href="../contactus.php" data-reactid="35">
                          <span class="link_layer" data-text="Contact Us" data-reactid="36"></span>Contact Us
                       </a>
                    </li>
                 </ul>
                 <ul class="menu_list menu_list-alter" data-reactid="38">
                    <li class="menu_item" data-reactid="39">
                       <a class="menu_link" href="../logout.php" data-reactid="40">
                          <span class="link_layer" data-text="Blog" data-reactid="41"></span>Logout
                       </a>
                    </li>
                    
                 </ul>
              </nav>

            </div>
        </div>

    </header>
    <section>
        <div class="search-container">
            <input type="text" id="search" placeholder="Search..">
        </div>
        <?php
        // Establish connection to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "oneforall";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch services from the database
        $sql = "SELECT service_title FROM services"; // Corrected column name
        $result = mysqli_query($conn, $sql);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            echo '<div id="category-list">';
            // Loop through each row and echo the service titles as categories
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="serviceproviderlist.php?category=' . urlencode($row['service_title']) . '" class="category">' . $row['service_title'] . '</a>';
   
            }
            echo '</div>';
        } else {
            echo '<p style="text-align: center;">No services found<p>';
        }

        // Close the connection
        mysqli_close($conn);
        ?>


    </section>
    <!--footer section -->
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    </head>

    <body>
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









        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <script>
            const search = document.getElementById("search");
            const categoryList = document.getElementById("category-list");

            search.addEventListener("keyup", () => {
                const searchTerm = search.value.toLowerCase();
                const categories = categoryList.getElementsByTagName("a");

                for (let i = 0; i < categories.length; i++) {
                    const category = categories[i];
                    const categoryText = category.textContent || category.innerText;

                    if (categoryText.toLowerCase().includes(searchTerm)) {
                        category.style.display = "block";
                    } else {
                        category.style.display = "none";
                    }
                }
            });
        </script>

    </body>

</html>