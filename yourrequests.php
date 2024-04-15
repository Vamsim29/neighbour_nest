<?php 
include("stdheader.php");
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Request</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* style for add donation button */
         /* Style for the div */
    .button-container {
        
        margin-top: 20px;
    }
    /* Style for the button */
    .styled-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        
        text-decoration: none;
        border-radius: 5px;
        background-color: #3498db;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Hover effect for the button */
    .styled-button:hover {
        background-color: #2980b9;
    }
    </style>
</head>
<body>
    <div style="padding:10px;">
        <h2>Your Requests</h2>
        <div class="button-container">
            <button class="styled-button"><a href="newrequest.php" style="color: inherit; text-decoration: none;">Add Request</a></button>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Description</th>
                    <th>Accepted By</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $userId = $_COOKIE['varus_name']; 

                $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $mongoClient->communihelp->requests;
                    
                // Query to extract all the data in collection
                $result = $collection->find();
                // Function to fetch user details by ID
                $serialNumber = 1; // Initialize the serial number
                // Display retrieved orders in the table
                // Display retrieved orders in the table
                if (!empty($result)) {
                    foreach ($result as $document) {
                    foreach ($document['data'] as $row) {
                    if ($row['roomid'] === $userId) {
                        echo "<tr>";
                        echo "<td>" . $serialNumber . "</td>"; // Output the serial number
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["accbyroomid"] .",phno: ". $row["accbymobno"] ."</td>";
                        echo "<td>" ; 
                        $tellstatus=$row["status"];
                        $telldatetime=$row["datatime"];
                        ?>
                        <form action="" method="POST">
                                <div class="col col-4" data-label="Change">
                                    <select name="cstatusuu">
                                        <option <?php if($tellstatus=="Needed"){echo "selected";} ?> value="Needed">Needed</option>
                                        <option <?php if($tellstatus=="Taken"){echo "selected";} ?> value="Taken">Taken</option>
                                    </select>
                                </div>
                                <input type="hidden" name="ruserid" value="<?php echo $userId; ?>">
                                <input type="hidden" name="rdatetime" value="<?php echo $telldatetime; ?>">
                                <input type="submit" name="done" value="UPDATE" class="btn-primary">
                            </form>
                        <?php
                        echo "</td></tr>";
                        $serialNumber++; // Increment the serial number
                    }
                }
                }
                } else {
                    echo "<tr><td colspan='3'>No requests have been made as of now.</td></tr>";
                }
                ?>
                <?php
                function updateYourRequests($client,$dtm, $uid, $usts)
                {
                    $coll = $client->communihelp->requests;
                    echo $dtm;
                    echo $uid;
                    echo $usts;
                    $updateResult = $coll->updateOne(
                    ['data.roomid' => $uid , 'data.datatime' => $dtm],
                    [
                        '$set' => [
                        'data.$.status' => $usts,
                    ],
                    ]
                    );
                    return $updateResult->getModifiedCount() > 0;
                }
                if (isset($_POST['done'])) {
                    $ddatetime=$_POST['rdatetime'];  
                    $droomid = $_POST['ruserid'];
                    $dstatus = $_POST['cstatusuu'];
                    $mC = new MongoDB\Client("mongodb://localhost:27017");
                    if(updateYourRequests($mC,$ddatetime,$droomid,$dstatus)){
                        echo "<p class='success-message'>Data updated Successfully.</p>";
                       } else {
                        echo "<p class='error-message'>Failed to update user details.</p>";
                       }
                } else {
                    echo "<p class='error-message'>.</p>";
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
