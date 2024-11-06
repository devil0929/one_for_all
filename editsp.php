<!DOCTYPE html>
<html>
<head>
    <title>edit your data</title>
    <style>
        body {
            background-color: black;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        #registration-form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="text"], input[type="email"], input[type="tel"], input[type="url"], textarea, button[type="submit"], button[type="button"],input[type="password"],input[type="date"],input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

       

        button[type="submit"], button[type="button"] {
            background-color: #4CAF50;
            cursor: pointer;
        }

        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #45a049;
        }

        .service-group {
            border: 1px solid #555;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #444;
        }

        .service-group .form-group {
            margin-bottom: 0;
        }

        .remove-service-btn {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
            float: right;
        }

        .remove-service-btn:hover {
            background-color: #d32f2f;
        }

        .other-title {
            display: none;
        }
    </style>
</head>
<body>
    <form id="registration-form" action="./service provider/submit_sp2.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
        <h1>Edit your infomation</h1>
        <div class="form-group">
            <label for="service-provider-title">Service Provider Title:</label>
            <input type="text" id="service-provider-title" name="service-provider-title" required>
        </div>

        <div class="form-group">
            <label for="service-provider-image">Service Provider Image:</label>
            <input type="file" id="service-provider-image" name="service-provider-image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="full-name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>

        <div class="form-group">
            <div class="services-container">
                <!-- Initially, no service group -->
            </div>
    
            <button type="button" id="add-service-btn">Add Service</button>
        </div>

       

        <div class="form-group">
            <label for="social-links-for-instagram">Social Links for Instagram:</label>
            <input type="url" id="social-links-for-instagram" name="social-links-for-instagram">
        </div>

        <div class="form-group">
            <label for="social-links-for-facebook">Social Links for Facebook:</label>
            <input type="url" id="social-links-for-facebook" name="social-links-for-facebook">
        </div>

        <div class="form-group">
            <label for="social-links-for-twitter">Social Links for Twitter:</label>
            <input type="url" id="social-links-for-twitter" name="social-links-for-twitter">
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="about-me">About Me (30 to 60 words):</label>
            <textarea id="about-me" name="about-me" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addServiceBtn = document.getElementById("add-service-btn");
            const servicesContainer = document.querySelector(".services-container");

            addServiceBtn.addEventListener("click", function() {
                const newServiceHtml = `
                    <div class="service-group">
                        <div class="form-group">
                            <label for="service-title">Service Title:</label>
                            <select class="service-title" name="service-title[]" style="background-color: black; color: white;">
                                <option value="">Select</option>
                                <option value="Delivery Services">Delivery Services</option>
                                <option value="Weddingplaner">Weddingplaner</option>
                                <option value="lawyer">lawyer</option>
                                <option value="Photographers">Photographers</option>
                                <option value="Event Organiser">Event Organiser</option>
                                <option value="Delivery Services">Delivery Services</option>
                                <option value="FurnitureRepairservices">Furniture Repair services</option>
                                <option value="HousekeepingServices">Housekeeping Services</option>
                                <option value="Other">Other</option>
                            </select>
                            <input type="text" class="other-title" style="display:none;" placeholder="Enter Service Title">
                        </div>
                        <div class="form-group">
                            <label for="service-description">Service Description:</label>
                            <input type="text" class="service-description" name="service-description[]" maxlength="500" required>
                        </div>
                        <button type="button" class="remove-service-btn">Remove</button>
                    </div>
                `;

                const serviceGroup = document.createElement("div");
                serviceGroup.classList.add("service-group");
                serviceGroup.innerHTML = newServiceHtml;

                servicesContainer.appendChild(serviceGroup);

                // Attach event listener to remove button
                const removeServiceBtns = document.querySelectorAll(".remove-service-btn");
                removeServiceBtns.forEach(btn => {
                    btn.addEventListener("click", function() {
                        this.closest(".service-group").remove();
                    });
                });

                // Attach event listener to service title dropdown
                const serviceTitleDropdowns = document.querySelectorAll(".service-title");
                serviceTitleDropdowns.forEach(dropdown => {
                    dropdown.addEventListener("change", function() {
                        const otherTitleInput = this.parentElement.querySelector(".other-title");
                        if (this.value === "Other") {
                            otherTitleInput.style.display = "block";
                        } else {
                            otherTitleInput.style.display = "none";
                        }
                    });
                });
            });
        });
    function validateForm() {
        // Check if all required fields are filled
        const requiredFields = document.querySelectorAll('input[required], textarea[required]');
        for (const field of requiredFields) {
            if (!field.value.trim()) {
                alert(`Please fill in ${field.previousElementSibling.textContent.replace(':', '')}`);
                field.focus();
                return false;
            }
        }
        
        // Additional validation for about me field
        const aboutMeField = document.getElementById('about-me');
        const aboutMeWordsCount = aboutMeField.value.trim().split(/\s+/).length;
        if (aboutMeWordsCount < 30 || aboutMeWordsCount > 60) {
            alert("Please provide an about me description between 30 and 60 words.");
            aboutMeField.focus();
            return false;
        }

        return true; // Form submission allowed
    }
    </script>
</body>
</html>
