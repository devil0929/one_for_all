<html>

<head>
  <style>
    body {
      text-align: center;
      padding: 40px 0;
      background: #EBF0F5;
    }

    h1 {
      color: #88B04B;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-weight: 900;
      font-size: 40px;
      margin-bottom: 10px;
    }

    p {
      color: #404F5E;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-size: 20px;
      margin: 0;
    }

    i {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left: -15px;
    }

    .card {
      background: white;
      padding: 60px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <?php
  // Database connection settings
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "oneforall";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $service_provider_title = $_POST["service-provider-title"];
    $full_name = $_POST["full-name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $birthday = $_POST["birthday"];
    $location = $_POST["location"];
    $portfolio = $_POST["portfolio"];
    $instagram = $_POST["social-links-for-instagram"];
    $facebook = $_POST["social-links-for-facebook"];
    $twitter = $_POST["social-links-for-twitter"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $about_me = $_POST["about-me"];
    $filename = $_POST["uploadfile"];
 

    // Insert data into service_providers table
    $stmt_provider = $conn->prepare("INSERT INTO service_providers (service_provider_title, service_provider_image, full_name, email, phone, birthday, location, portfolio, instagram, facebook, twitter, username, password, about_me) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_provider->bind_param("ssssssssssssss", $service_provider_title, $filename, $full_name, $email, $phone, $birthday, $location, $portfolio, $instagram, $facebook, $twitter, $username, $password, $about_me);
    $stmt_provider->execute();
    $stmt_provider->close();

    // Get the ID of the inserted service provider
    $provider_id = $conn->insert_id;

    // Insert services into the services table
    if (isset($_POST["service-title"]) && isset($_POST["service-description"])) {
      $service_titles = $_POST["service-title"];
      $service_descriptions = $_POST["service-description"];

      // Prepare and bind SQL statement for inserting services
      $stmt_service = $conn->prepare("INSERT INTO services (provider_id, service_title, service_description) VALUES (?, ?, ?)");
      $stmt_service->bind_param("iss", $provider_id, $service_title, $service_description);

      // Insert each service
      for ($i = 0; $i < count($service_titles); $i++) {
        $service_title = $service_titles[$i];
        $service_description = $service_descriptions[$i];

        // Execute the prepared statement
        $stmt_service->execute();
      }

      // Close the prepared statement
      $stmt_service->close();
    }

    // Close the database connection
    $conn->close();
    echo "✓</i>
    </div>
      <h1>Registration successful</h1> 
      <p>thankyou for register<br/>page will rredirect to login page</p>
    </div>";
    echo "<script>
          setTimeout(function() {
              window.location.href = 'your_redirect_page.php';
          }, 5000);
        </script>";
  }

  ?>
</body>

</html>