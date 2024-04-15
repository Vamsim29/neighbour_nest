<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
  <style>
        /* Reset default margin and padding for all elements */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif; /* Change the font-family to Poppins */
            background-color: #f4f4f4;
        }
        h1{
        text-align: center;
        color: #1676eb;
            margin-bottom: 20px;
            font-family: 'Poppins', Arial, sans-serif; /* Apply Poppins to headings */
            font-weight: 600;
        }
        .container {
            width: 80%;
            margin: 2px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Poppins', Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6; /* Improve readability with increased line height */
        }

        button {
            margin-top: auto;
            padding: 10px 20px;
            background-color: #b5d7a6;
            color: #000000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            /* Additional style enhancements */
            font-weight: 500; /* Adjust font weight for buttons */
            transition: background-color 0.3s ease; /* Add smooth hover transition */
        }
        button:hover {
            background-color: #e2ff07;
        }
        .one{
            font-family: 'Poppins', Arial, sans-serif; /* Change the font-family as needed */
            background-color: #f4f4f4; /* Set a background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }
    </style>
</head>
<body>
         <div class="heading"><!-- need to be at the center of the page -->
         <br>
        <h1>Profile</h1>
        </div>
        <div class="one">
        <div class="container">
        <?php
            // include connection to database
            require 'vendor/autoload.php';

                // Retrieving the cookie here - created in loginprocess.php
                $userId = $_COOKIE['varus_name']; 

                // Connection to MongoDB
                $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $mongoClient->communihelp->basiclogin;

                // Function to fetch user details by ID from MongoDB
                function getUserDetails($collection, $user)
                {
                    $result = $collection->findOne(['data' => ['$elemMatch' => ['userid' => $user]]]);

                    if ($result) {

                        $data = $result['data'];
                        $matchedIndex=0;
                       foreach ($data as $index => $element) {
                        if ($element['userid'] == $user) {
                            // $index now contains the index where 'userid' matches $user
                            $matchedIndex = $index;
                            break;
                            }
                        }
                        return $result['data'][$matchedIndex]; // Assuming the first match is the correct user
                    }

                    return false;
                }

                // Get user details
                $userDetails = getUserDetails($collection, $userId);

            if ($userDetails) {
                // Display user details
                echo "<div class='card' style='font-family: 'Poppins', Arial, sans-serif;'> <i class='icon fas fa-user'></i>";
                echo "<p>Name : " . $userDetails['username'] . "</p>";
                echo "</div>";
                echo "<div class='card'> <i class='icon fas fa-id-card'></i></i>";
                echo "<p>UserId : " . $userDetails['userid'] . "</p>";
                echo "</div>";
                echo "<div class='card'> <i class='icon fas fa-calendar-alt'></i>";
                echo "<p>Date of Birth : " . $userDetails['dob'] . "</p>";
                echo "</div>";
                echo "<div class='card'> <i class='icon fas fa-mobile-alt'></i>";
                echo "<p>Mobile Number : " . $userDetails['mobileno'] . "</p>";
                echo "</div>";
                echo "<div class='card'> <i class='icon fas fa-envelope'></i>";
                echo "<p>Email : " . $userDetails['email'] . "</p>";
                echo "</div>";
                echo "<div class='card'> <i class='icon fas fa-edit'></i>";
                echo '<a href="stdprofileedit.php" style="text-decoration: none;"><button> Edit</button> </a>';
                echo "</div>";

            } else {
                echo "<p class='error-message'>User not found.</p>";
            }

        ?>
    </div>
    </div>
</body>
</html>
