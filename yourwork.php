
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Home/master.css" />

    <link rel="stylesheet" href="CSS/Home/firstcard.css" />

    <link rel="stylesheet" href="CSS/Home/firstanimation.css" />
    <link rel="stylesheet" href="CSS/Home/footer.css" />
    <style>
 
      /* Table styling */
/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border: 1px solid white; /* Set border color to white */
}



th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    color: white; /* Set text color to white */
    text-align: left; /* Align text to the left */
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
    color: #fff; /* Set text color to white */
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
    <h1 class="headplace" style="text-align: center;">Accepted Works</h1>
    <div class="content-container">
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

// Fetch data from the work table with status="pending" and join with service_providers table
$sql = "SELECT work.id, service_providers.full_name AS provider_name, service_providers.email AS provider_email, 
               work.customername, work.customer_email, work.customer_message, work.status, work.created_at 
        FROM work 
        INNER JOIN service_providers ON work.serviceproviderid = service_providers.id 
        WHERE work.status='pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Provider Name</th>
                    <th>Provider Email</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["provider_name"] . "</td>";
        echo "<td>" . $row["provider_email"] . "</td>";
        echo "<td>" . $row["customername"] . "</td>";
        echo "<td>" . $row["customer_email"] . "</td>";
        echo "<td>" . $row["customer_message"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td><button onclick=\"acceptRequest(" . $row["id"] . ")\">complated</button></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No work requests found";
}

$conn->close();
?>

     </div>
        <!-- Ad Container -->
       
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
    function acceptRequest(id) {
        // Redirect to complate_status.php with the id as a query parameter
        window.location.href = "complate_status.php?id=" + id;
    }
</script>

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