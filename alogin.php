<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the submitted username and password match the admin credentials
    if ($_POST['username'] === 'admin' && $_POST['password'] === '123') {
        // If credentials are correct, redirect to Adashbord.php
        header("Location: Dadmin.php");
        exit; // Stop further execution
    } else {
        // If credentials are incorrect, display an error message
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        * {
    margin: 0;
    padding: 0;

    font-family: "poppins", sans-serif;
}

body{
    background-color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url("photos/login/bg.jpg") no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;
}

.box{
    width: 400px;
    height: 450px;
    border: 2px solid  #625d5d;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    backdrop-filter: blur(15px);
    background: transparent;
}

h2{
    font-size: 2em;
    color: #fff;
    text-align: center;
}

.inputbox{
    position: relative;
    margin: 30px 0;
    width: 300px;
    border-bottom: 2px solid#fff;
}

.inputbox label{
    position: absolute ;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em ;
    pointer-events: none;
    transition: 0.5s;
}

input:focus ~ label{
    top: -5px;
}

input:focus ~ label,
input:not(:placeholder-shown) ~ label {
    top: -5px;
}


.inputbox input{
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding: 0 35px 0 5px;
    color: #000;
}

.inputbox ion-icon{
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2em;
    top: 20px;
}


button{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background-color: #e6e2e2;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1.3em;
    font-weight: 700;
}

.forget{
    display: flex;
    justify-content: space-between;
    margin: 10px 0 15px;
    font-size: 0.9em;
    color: #fff;
}

.forget label:nth-child(2){
    order: 1;
}

.forget label{
    display: flex;
    align-items: center;
}

.forget label input[ type="checkbox"]{
    margin-right: 6px
}

.forget label a {
    color: #fff;
    text-decoration: none;
}

.forget label a:hover{
    text-decoration: underline;
}

.register {
    font-size: 0.9em;
    color: #fff;
    text-align: center;
    margin: 20px 0 15px;
}

.register p a{
    text-decoration: none;
    color: #fff;
    font-weight: 800;
}

.register p a:hover{
    text-decoration: underline;
}



    </style>
   
</head>
<body>

    <div class="box">

        <form  method="post">

            <h2>Admin <br> Login Here</h2>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="username" name="username" required>
                <label for="">UserID</label>
            </div>

            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" id="password" name="password" required>
                <label for="">Password:</label>
            </div>

            <div class="forget">
                <label for="">
                    <input type="checkbox">Remember me
                </label>
                
            </div>
            <button> Log In</button>
            

            <div class="register">
               
                <p>  <a href="slogin.php">service provider Login Here</a><br><a href="clogin.php">customer Login Here</a></p>
             
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Array of background images
            const backgroundImages = [
                "photos/login/bg.jpg",
                "photos/login/bg2.jpg",
                
                // Add more images as needed
            ];

            // Get a random index to select a background image
            const randomIndex = Math.floor(Math.random() * backgroundImages.length);

            // Set the background image
            document.body.style.backgroundImage = `url("${backgroundImages[randomIndex]}")`;
        });
    </script>





</body>
</html>