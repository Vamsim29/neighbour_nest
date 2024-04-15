<?php 
include("stdheader.php");
require 'vendor/autoload.php';
function getUserDataa($collection, $user)
{
    $resu = $collection->findOne(['data' => ['$elemMatch' => ['userid' => $user]]]);

    if ($resu) {
                $data = $resu['data'];
                $matchedIndex = 0;
                    foreach ($data as $index => $element) {
                    if ($element['userid'] == $user) {
                            // $index now contains the index where 'userid' matches $user
                            $matchedIndex = $index;
                            break;
                        }
                }
                return $resu['data'][$matchedIndex]; // Assuming the first match is the correct user
            }
        return false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
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
    </style>
</head>
<body>
    <div style="padding:10px;">
    <h2>Inbox Donations</h2>
        <table>
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                //retrieving the cookie here - created in loginprocess.php
                $userId = $_COOKIE['varus_name']; 

                    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                    $collection = $mongoClient->communihelp->donations;
                    
                    // Query to find documents with roomid 't24f'
                    $result = $collection->find();

                    $serialNumber = 1; // Initialize the serial number
                    // Display retrieved orders in the table
                    if (!empty($result)) {
                       foreach ($result as $document) {
                    foreach ($document['data'] as $row) {
                    if ($row['roomid'] != $userId) {
                        $donatorroomid=$row["roomid"];
                        $donatordatetime=$row["datatime"];
                        echo "<tr>";
                        echo "<td>" . $serialNumber . "</td>"; // Output the serial number
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>";
                        //to check wether the donation is available or taken by others
                        $statusstatus=$row["status"];
                        if($statusstatus=='Available')
                        {
                            //collecting the user details who is taking the donations
                            // Function to get user mobile number
                            $collectionn = $mongoClient->communihelp->basiclogin;

                            // Get user details
                            $userDetails = getUserDataa($collectionn, $userId);
                            if ($userDetails) {
                              // Access the mobile number value
                                $user_mobile_number = isset($userDetails['mobileno']) ? $userDetails['mobileno'] : '';
                              echo '<form action=""  method="POST">
                                    <input type="hidden" name="indatetime" value="' . $donatordatetime . '">
                                    <input type="hidden" name="donatoruserid" value="' . $donatorroomid . '">
                                    <input type="hidden" name="userid" value="' . $userId . '">
                                    <input type="hidden" name="usermblno" value="' . $user_mobile_number. '">
                                <input type="submit" name="done" id="" value="Take It" style="padding: 5px 10px; 
                                color: #fff; 
                                background-color: #3498db; 
                                border: none; 
                                border-radius: 5px; 
                                cursor: pointer; 
                                text-align: center; 
                                text-decoration: none;"></form>';
                                }
                            }
                        else
                        {
                            echo "<label style='color: red;'>$statusstatus</label>";
                        }
                        echo "</td>";
                        echo "</tr>";
                        $serialNumber++; // Increment the serial number
                    }
                    }
            }
                } else {
                    echo "<tr><td colspan='3'>No orders found for this user.</td></tr>";
                }
                ?>
                <?php
                function updateInboxDonations($client, $Id, $dtm, $uid, $uphno)
                {
                    $colle = $client->communihelp->donations;
                    echo $Id;echo $dtm;echo $uid;echo $uphno;
                    
                    $updateRes = $colle->updateOne(
                    ['data.datatime' => $dtm],
                    [
                        '$set' => [
                        'data.$.accbyroomid' => $uid,
                        'data.$.accbymobno' => $uphno,
                        'data.$.status' => "Taken",
                    ],
                    ]
                    );
                
                    return $updateRes->getModifiedCount() > 0;
                }
                if (isset($_POST['done'])) {
                    $ddatetime=$_POST['indatetime'];   
                    $donaroomid=$_POST['donatoruserid'];
                    $droomid = $_POST['userid'];
                    $dmbln = $_POST['usermblno'];
                    $mCC = new MongoDB\Client("mongodb://localhost:27017");
                    if (updateInboxDonations($mCC,$donaroomid,$ddatetime,$droomid,$dmbln)) {
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