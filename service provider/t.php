<?php
if(isset($_GET['category'])) {
    $category = "Logo Design";
    // Now you can use $category variable to get the value passed from the previous page
    $_COOKIE['catagory']=$category;
} else {
    echo "Category not specified.";
}
?>
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
        .headplace {
    color: #FFFFFF; /* White header text color */
    text-align: center;
}

.content-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.serviceprovider-list {
    width: 80%;
    padding-right: 20px;
}

.serviceprovider-container {
    width: 96%;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 20px;
    display: flex;
    cursor: pointer;
    background-color: black; /* Dark gray background color */
    border-radius: 8px;
}

.imgcl {
    width: 200px;
    height: 200px;
    overflow: hidden;
    border-radius: 8px;
}

.imgcl img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.service-details {
    flex: 1;
    padding-left: 20px;
}

.service h2 {
    margin-top: 0;
    color: #FFFFFF; /* White text color for heading */
    font-size: 1.5em;
    margin-bottom: 10px;
}

.service p {
    margin-bottom: 8px;
    font-size: 1.1em;
}

.ad-container {
    width: 20%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 20px;
    display: flex;
    cursor: pointer;
    background-color: black; /* Dark gray background color */
    border-radius: 8px;
}

.ad-img {
    width: 100%;
    border-radius: 8px;
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
      
        <?php
// Check if the cookie is set before accessing it
if (isset($_COOKIE['catagory'])) {
    echo '<h1 class="headplace">' . $_COOKIE['catagory'] . '</h1>';
} else {
    // Handle the case when the cookie is not set
    echo '<h1 class="headplace">Default Category</h1>'; // You can set a default value here
}
?>

    

    <!-- Search Bar and Sorting Options -->
    <div class="search-container">
            <input type="text" id="search" placeholder="Search..">
        </div>
       

    <div class="content-container">
        <!-- Hospital List -->
        <div class="serviceprovider-list" id="hospitalList">
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

            $sql = "SELECT * FROM services WHERE service_title='Logo Design'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Fetch provider details from service_providers table based on provider_id
                    $provider_sql = "SELECT * FROM service_providers WHERE id=" . $row['provider_id'];
                    $provider_result = $conn->query($provider_sql);
            
                    if ($provider_result->num_rows > 0) {
                        // Output data of each provider
                        while ($provider_row = $provider_result->fetch_assoc()) {
                            echo '<a href="about_serviceprovider.php?id=' . $provider_row['id'] . '" class="serviceprovider-link">';
                            echo '<div class="serviceprovider-container">';
                            echo '<img class="imgcl" src="Photos/login/'.$provider_row["service_provider_image"].'" alt="' . $provider_row["full_name"] . '">';
                            echo '<div class="service-details">';
                            echo '<h2>' . $provider_row["full_name"] . '</h2>';
                            echo '<p>' . $provider_row["service_provider_title"] . '</p>';
                            echo '<p>Address: ' . $provider_row["location"] . '</p>';
                            echo '<p>Phone: ' . $provider_row["phone"] . '</p>';
                            echo '<p>email: ' . $provider_row["email"] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                        }
                    } else {
                        echo "0 results";
                    }
                }
            } else {
                echo "0 results";
            }
            $conn->close();
           
            ?>
        </div>
        <!-- Ad Container -->
        <div class="ad-container">
            <!-- Ad images will be added here -->
            <img class="ad-img" src="Photos/login/bg2.jpg" alt="Ad 1">
            <img class="ad-img" src="path/to/ad2.jpg" alt="Ad 2">
           
        </div>
    </div>


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