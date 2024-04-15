<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    /* Your existing CSS plus additional styles for the update form */

body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

.container {
    width: 60%;
    margin: 20px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h3 {
    text-align: center;
    margin-bottom: 30px;
}

input[type="text"],
input[type="password"],
input[type="date"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

h5 {
    margin-bottom: 5px;
}

.submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #2980b9;
}

.error-message {
    color: #ff0000;
    margin-top: 10px;
}

.success-message {
    color: #00ff00;
    margin-top: 10px;
}
</style>
</head>
<body>
    <div class="container">
    <h3>Update Data</h3>
    <?php
    require 'vendor/autoload.php';
    //retrieving the cookie here - created in loginprocess.php
        $userId = $_COOKIE['varus_name'];
    //function to change password
    function updateUserDetails($client, $userId, $password, $pusername, $pdob, $pmblno)
{
    $collection = $client->communihelp->basiclogin;

    $updateResult = $collection->updateOne(
        ['data.userid' => $userId],
        [
            '$set' => [
                'data.$.password' => $password,
                'data.$.username' => $pusername,
                'data.$.dob' => $pdob,
                'data.$.mobileno' => $pmblno,
            ],
        ]
    );

    return $updateResult->getModifiedCount() > 0;
}

// Usage example
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    // Display update form
                echo "<form method='POST' action=''>
                       <input type='text' placeholder='UserName' name='fusername'><br><br>
                       <input type='date' placeholder='Date of Birth' name='fdateofbirth'><br><br>
                       <input type='text' placeholder='Mobile No' name='fmobileno'><br><br>
                       <h5>Password<h5><br>
                        <input type='password' name='passw' ><br>
                        <h5>Confirm Password</h5>
                        <input type='password' name='conpassw'><br>
                        <input type='submit' name='update' value='Update'>
                      </form>";

                // Process form submission
                if (isset($_POST['update'])) {
                    $password = $_POST['passw'];
                    $conformpassword = $_POST['conpassw'];
                    $pusername=$_POST['fusername'];
                    $pdob=$_POST['fdateofbirth'];
                    $pmblno=$_POST['fmobileno'];
                    //to check wether the password and conform new password both are same or not
                    if($conformpassword==$password)
                    {
                        // Update user details
                    if (updateUserDetails($mongoClient, $userId, $password,$pusername,$pdob,$pmblno)) {
                        echo "<p class='success-message'>Password details updated successfully.</p>";
                       } else {
                        echo "<p class='error-message'>Failed to update user details.</p>";
                       }
                    }
                    else
                    {
                        echo "New-Password and Conform-New-Password should be same";
                    }
                }
             else {
                echo "<p class='error-message'>.</p>";
            }

            // Close the database connection
            // $conn->close();
    ?>
    </div>
</body>
</html>