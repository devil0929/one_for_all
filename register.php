<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
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
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
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
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
      <i class="checkmark">

<?php
// Assuming you have a database connection, replace the placeholders with your actual database credentials
$servername = "localhost";
$dbname = "oneforall";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $gmail = $_POST["gmail"];
    $city = $_POST["city"];
    $pan_card = $_POST["pan_card"];
    $password = $_POST["password"];
    $services = isset($_POST["service"]) ? $_POST["service"] : [];

    // Sanitize input data to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $name = mysqli_real_escape_string($conn, $name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $gmail = mysqli_real_escape_string($conn, $gmail);
    $city = mysqli_real_escape_string($conn, $city);
    $pan_card = mysqli_real_escape_string($conn, $pan_card);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password for better security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the 'ServiceProviders' table
    $sql_user = "INSERT INTO ServiceProviders (username, name, phone, gmail, city, pan_card, password, rating) VALUES ('$username', '$name', '$phone', '$gmail', '$city', '$pan_card', '$hashed_password', 0)";

    if ($conn->query($sql_user) === TRUE) {
        // Get the user ID of the newly inserted user
        $user_id = $conn->insert_id;

        // Insert selected services into the 'UserServices' table
        foreach ($services as $service) {
            $service = mysqli_real_escape_string($conn, $service);
            $sql_services = "INSERT INTO UserServices (user_id, service) VALUES ($user_id, '$service')";
            $conn->query($sql_services);
        }

        
        echo"✓</i>
      </div>
        <h1>Registration successful</h1> 
        <p>thankyou for register<br/>page will rredirect to login page</p>
      </div>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'your_redirect_page.php';
            }, 5000);
          </script>";

    } else {
        echo"✖</i>
        </div>
          <h1>Registration unsuccessful</h1> 
                 </div>";
          echo "<script>
              setTimeout(function() {
                  window.location.href = 'your_redirect_page.php';
                
              }, 5000);
            </script>";
    }
}

// Close the database connection
$conn->close();
?>

    </body>
</html>