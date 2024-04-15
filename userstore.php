<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <style>
        /* Custom styles for the buttons */
        body {
            background-color: #fff; /* White background */
            font-family: 'Roboto', sans-serif; /* Changed font style */
            margin: 0;
            padding: 0;
        }

        p{
           font-family: 'Poppins', Arial, sans-serif;
        }

        /* Updated button styles */
        .button-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 50px;
        }

        .button {
            text-align: center;
            cursor: pointer;
            border: 2px solid #3498db; /* Blue border */
            border-radius: 15px;
            padding: 20px;
            transition: transform 0.3s ease-in-out;
            background-color: #fff; /* White background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Box shadow */
        }

        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); /* Larger shadow on hover */
        }

        .button img {
            border-radius: 50%;
            max-width: 80px;
            max-height: 80px;
            margin-bottom: 10px;
            border: 2px solid #3498db; /* Border around images */
            padding: 5px; /* Padding around images */
        }

        /* Background decoration */
        .background-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: #fff; /* White background */
            opacity: 0.5; /* Adjust opacity */
        }

        /* Container styles */
        .container {
            position: relative;
            z-index: 1;
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
        <h1>Store</h1>
    </div>
    <div class="background-pattern"></div> <!-- Background decoration -->
    <div class="container">
        <div class="row button-container">
            <div class="col-md-4">
                <div class="button" onclick="redirectToPlex('Cylinder')">
                    <img src="gascylindder.jpg" alt="Cylinder" height="100" width="100">
                    <p>Book a Cylinder</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button" onclick="redirectToPlex('WaterCan')">
                    <img src="watercan.jpg" alt="WaterCan" height="100" width="100">
                    <p>Book a Watercan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button" onclick="redirectToPlex('RiceBag')">
                    <img src="firrice_bag.jpg" alt="RiceBag" height="100" width="100">
                    <p>Book a RiceBag</p>
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

