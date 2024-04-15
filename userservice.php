<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the buttons */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7; /* Light gray background */
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap; /* Wrap items to the next line */
            margin-top: 50px;
        }

        p {
            margin: 0; /* Remove default margin for paragraphs */
        }

        .button {
            flex: 0 0 calc(50% - 20px); /* Set width for 2 columns */
            margin-bottom: 20px; /* Spacing between rows */
            text-align: center;
            cursor: pointer;
            border: 2px solid #3498db;
            border-radius: 15px;
            padding: 20px;
            transition: transform 0.3s ease-in-out;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .button img {
            border-radius: 50%;
            max-width: 80px;
            max-height: 80px;
            margin-bottom: 10px;
            border: 3px solid #3498db;
            padding: 5px;
            transition: transform 0.3s ease-in-out;
        }

        .button:hover img {
            transform: rotate(360deg);
        }

        h1{
        text-align: center;
        color: #1676eb;
            margin-bottom: 20px;
            font-family: 'Poppins', Arial, sans-serif; /* Apply Poppins to headings */
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="heading"><!-- need to be at the center of the page -->
         <br>
        <h1>Services</h1>
    </div>
    <div class="container">
        <div class="row button-container">
            <div class="col-md-6">
                <div class="button" onclick="redirectToPlex('Cleaning Service')">
                    <img src="firroom_cleaning_service.jpg" alt="Room Cleaning" height="100" width="100">
                    <p>Cleaning Service</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button" onclick="redirectToPlex('Electrician')">
                    <img src="firelectrician .jpg" alt="Electrician" height="100" width="100">
                    <p>Electrician</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button" onclick="redirectToPlex('Laundry Service')">
                    <img src="Firroom_laundry.jpg" alt="room Laundry" height="100" width="100">
                    <p>Laundry Service</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button" onclick="redirectToPlex('Plumber')">
                    <img src="firplumber_service.jpg" alt="Plumber Service" height="100" width="100">
                    <p>Plumber</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirectToPlex(buttonText) {
            const url = `serviceform.php?text=${encodeURIComponent(buttonText)}`;
            window.location.href = url;
        }
    </script>
</body>
</html>
