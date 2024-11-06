<?php
$conn = mysqli_connect("localhost", "root", "", "oneforall");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Now you can use $category variable to get the value passed from the previous page
    $_COOKIE['username']=$id;
    setcookie("id", $id, time() + 36000, "/");
} else {
    echo "Category not specified.";
}

$_COOKIE['username']="emilyj";
// Check if username cookie is set
if(isset($_COOKIE['username'])) {
    $username =$_COOKIE['username'];
    
    // Fetch data of the user from service_providers table
    $sql_user = "SELECT * FROM service_providers WHERE id=".$id;
    $result_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($result_user) > 0) {
        $user_row = mysqli_fetch_assoc($result_user);
        
        // Fetch services provided by the user
        $provider_id = $user_row['id'];
        $sql_services = "SELECT * FROM services WHERE provider_id='$provider_id'";
        $result_services = mysqli_query($conn, $sql_services);
    } else {
        echo "User not found!";
        exit; // Exit if user not found
    }
} else {
    echo "Username cookie not set!";
    exit; // Exit if username cookie not set
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service provider info</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

  <!--
    - #MAIN
  -->

  <main>

    <!--
      - #SIDEBAR
    -->

    <aside class="sidebar" data-sidebar>

      <div class="sidebar-info">
  
      <figure class="avatar-box" id="user-photo">
    <img src="../Photos/<?php echo $user_row['service_provider_image']; ?>" alt="<?php echo $user_row['full_name']; ?>" width="80" height="120" style="border-radius: 10%;">
</figure>

          <div class="info-content">
              <h1 class="name" title="<?php echo $user_row['full_name']; ?>" id="fullname"><?php echo $user_row['full_name']; ?></h1>
  
              <p class="title" id="service-provider-title"><?php echo $user_row['service_provider_title']; ?></p>
          </div>
  
          <button class="info_more-btn" data-sidebar-btn>
              <span>Show Contacts</span>
  
              <ion-icon name="chevron-down"></ion-icon>
          </button>
  
      </div>
  
      <div class="sidebar-info_more">
  
          <div class="separator"></div>
  
          <ul class="contacts-list">
  
              <li class="contact-item">
  
                  <div class="icon-box">
                      <ion-icon name="mail-outline"></ion-icon>
                  </div>
  
                  <div class="contact-info">
                      <p class="contact-title">Email</p>
  
                      <a href="mailto:<?php echo $user_row['email']; ?>" class="contact-link" id="email"><?php echo $user_row['email']; ?></a>
                  </div>
  
              </li>
  
              <li class="contact-item">
  
                  <div class="icon-box">
                      <ion-icon name="phone-portrait-outline"></ion-icon>
                  </div>
  
                  <div class="contact-info">
                      <p class="contact-title">Phone</p>
  
                      <a href="tel:<?php echo $user_row['phone']; ?>" class="contact-link" id="phone"><?php echo $user_row['phone']; ?></a>
                  </div>
  
              </li>
  
              <li class="contact-item">
  
                  <div class="icon-box">
                      <ion-icon name="calendar-outline"></ion-icon>
                  </div>
  
                  <div class="contact-info">
                      <p class="contact-title">Birthday</p>
  
                      <time datetime="<?php echo $user_row['birthday']; ?>" id="Birthday"><?php echo date("F j, Y", strtotime($user_row['birthday'])); ?></time>
                  </div>
  
              </li>
  
              <li class="contact-item">
  
                  <div class="icon-box">
                      <ion-icon name="location-outline"></ion-icon>
                  </div>
  
                  <div class="contact-info">
                      <p class="contact-title">Location</p>
  
                      <address id="location"><?php echo $user_row['location']; ?></address>
                  </div>
  
              </li>
  
          </ul>
  
          <div class="separator"></div>
  
          <ul class="social-list">
  
              <li class="social-item">
                  <a href="<?php echo $user_row['facebook']; ?>" class="social-link" id="facebook">
                      <ion-icon name="logo-facebook"></ion-icon>
                  </a>
              </li>
  
              <li class="social-item">
                  <a href="<?php echo $user_row['twitter']; ?>" class="social-link" id="twitter">
                      <ion-icon name="logo-twitter"></ion-icon>
                  </a>
              </li>
  
              <li class="social-item">
                  <a href="<?php echo $user_row['instagram']; ?>" class="social-link" id="instagram">
                      <ion-icon name="logo-instagram"></ion-icon>
                  </a>
              </li>
  
          </ul>
  
      </div>
  
  </aside>
  





    <!--
      - #main-content
    -->

    <!-- Main content here -->
    <div class="main-content">
        <!-- About section -->
        <article class="about active" data-page="about">
            <header>
                <h2 class="h2 article-title">About me</h2>
            </header>
            <section class="about-text">
                <p id="about_me"><?php echo $user_row['about_me']; ?></p>
            </section>

            <!-- Service section -->
            <section class="service">
                <h3 class="h3 service-title">What I'm doing</h3>
                <ul class="service-list" id="service_list">
                    <?php
                    if (mysqli_num_rows($result_services) > 0) {
                        while ($service_row = mysqli_fetch_assoc($result_services)) {
                            echo "<li class='service-item'>";
                            echo "<div class='service-icon-box'></div>";
                            echo "<div class='service-content-box'>";
                            echo "<h4 class='h4 service-item-title'>" . $service_row['service_title'] . "</h4>";
                            echo "<p class='service-item-text'>" . $service_row['service_description'] . "</p>";
                            echo "</div>";
                            echo "</li>";
                        }
                    } else {
                        echo "No services found!";
                    }
                    ?>
                </ul>
            </section>
        <section class="contact-form">

          <h3 class="h3 form-title">Contact Form</h3>

          <form action="SR.php" class="form" data-form>

            <div class="input-wrapper">
              <input type="text" name="fullname" class="form-input" placeholder="Full name" required data-form-input>

              <input type="email" name="email" class="form-input" placeholder="Email address" required data-form-input>
            </div>

            <textarea name="message" class="form-input" placeholder="Your Message" required data-form-input></textarea>

            <button class="form-btn" type="submit">
              <ion-icon name="paper-plane"></ion-icon>
              <span>Send Message</span>
            </button>

          </form>

        </section>

      </article>

    </div>
    <button href="../CHome.php">hwllo</button>

  </main>






  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>