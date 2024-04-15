<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Service</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 55%;
            margin: 25px auto;
            background-color: #ffffff;
            padding: 25px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            color: #333;
            font-size: 36px;
            margin-bottom: 30px;
            text-align: center;
        }

        .serviceform {
            max-width: 400px;
            margin: 0 auto;
        }

        .serviceform label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            color: #555;
        }

        .serviceform input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
        }

        .serviceform input[type="text"]:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .serviceform input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .serviceform input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-style: italic;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $textFromButton = $_GET['text'];
        echo "<h2>Book A " . $textFromButton . "</h2><br>";
        ?>
        <div class="serviceform">
            <form method="post" action="">
                <label for="rname">Name</label>
                <input type="text" id="rname" name="rname" placeholder="Enter your name">
                <label for="rmblno">Mobile Number</label>
                <input type="text" id="rmblno" name="rmblno" placeholder="Enter your mobile number">
                <input type="submit" name="done" value="Submit">
            </form>
        </div>
        <?php
        // Connect to MongoDB (replace with your connection details)
            require 'vendor/autoload.php';
        $textFromButton = $_GET['text'];
        $userId = $_COOKIE['varus_name'];
        date_default_timezone_set('Asia/Kolkata');
        $orderstatus = "booked";
        $myDate = date('Y/m/d');
        $myTime = date('H:i:s');
        $datetime = $myDate . " " . $myTime;
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

        // Select the database and collection
        $collection = $mongoClient->communihelp->servicestore;

        if (isset($_POST['done'])) {
            $dname = $_POST['rname'];
            $dmblno = $_POST['rmblno'];
            
            // Insert document into MongoDB
            $data=[
                'roomid' => $userId,
                'name' => $dname,
                'mblno' => $dmblno,
                'service' => $textFromButton,
                'status' => $orderstatus,
                'datetime' => $datetime
            ];

            // Update the existing document in the collection
            $updateR = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID('65c0775cfb4b81a1bc9309c2')],
            ['$push' => ['data' => $data]]
            );

            if ($updateR->getModifiedCount() > 0) {
                echo "<p style='text-align: center; color: green;'>Store/Service Booking placed successfully.</p>";
            } else {
                echo "<p class='error-message'>Error placing order.</p>";
            }
        } else {
            echo "<p class='error-message'>.</p>";
        }
        ?>
    </div>
</body>
</html>
