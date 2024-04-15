<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Request</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
        }

        /* Form Styles */
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #da58d8;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #b8066b;
            
        }

        /* Typography and Spacing */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 300;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <br>
    <h1>Add Request</h1>
    <form action="" method="post">
        <label for="description">Name</label>
        <input type="text" id="iname" name="iname">
        <label for="mobileNumber">Description</label>
        <input type="text" id="des" name="des">
        <input type="submit" name="done" value="Submit Request">
    </form>
    <?php
        require 'vendor/autoload.php';
        $userId = $_COOKIE['varus_name'];
        date_default_timezone_set('Asia/Kolkata');
        $orderstatus = "booked";
        $myDate = date('Y/m/d');
        $myTime = date('H:i:s');
        $datetime = $myDate . " " . $myTime;
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongoClient->communihelp->requests;
        if (isset($_POST['done'])) {
            $dname = $_POST['iname'];
            $ddes = $_POST['des'];
            // Construct the data to be inserted
    $data = [
        "roomid" => $userId,
        "description" => $ddes,
        "accbyroomid" => "null",
        "accbymobno" => "1",
        "status" => "Needed",
        "datatime" => $datetime,
        "name" => $dname
    ];

        // Update the existing document in the collection
        $updateResult = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID('65c0774cfb4b81a1bc9309be')],
        ['$push' => ['data' => $data]]
        );

            // Check if update was successful
            if ($updateResult->getModifiedCount() > 0) {
            echo "Data Added Successfully We need to Update";
            } else {
                echo "Failed to insert data";
            }
        } else {
            echo "<p class='error-message'>.</p>";
        }
        ?>
</body>
</html>
