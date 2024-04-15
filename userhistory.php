<?php
// Connect to your database (replace with your connection details)
require 'vendor/autoload.php';
include("stdheader.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Store & Service's History</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #fff;
            text-transform: uppercase;
            border-radius: 6px 6px 0 0;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e0e0e0;
        }
        td {
            border-radius: 0 0 6px 6px;
        }

        /* Scrollable Table */
        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Store & Service's History</h1>
        <div class="scrollable-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Service Booked</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $userId = $_COOKIE['varus_name'];
                //collecting the data from the database
                $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $mongoClient->communihelp->servicestore; 
                // Query to find documents with roomid 't24f'
                $result = $collection->find(['data.roomid' => "t24f"]);
                // Display retrieved orders in the table
                if (!empty($result)) {
                    foreach ($result as $document) {
                    foreach ($document['data'] as $row) {
                    if ($row['roomid'] == $userId) {

        echo "<tr>";
        echo "<td>" . (isset($row["name"]) ? $row["name"] : "") . "</td>";
        echo "<td>" . (isset($row["mblno"]) ? $row["mblno"] : "") . "</td>";
        echo "<td>" . (isset($row["service"]) ? $row["service"] : "") . "</td>";
        echo "<td>" . (isset($row["datetime"]) ? $row["datetime"] : "") . "</td>";
        echo "<td>" . (isset($row["status"]) ? $row["status"] : "") . "</td>";
        echo "</tr>";
    }
}
}
                } else {
                    echo "<tr><td colspan='5'>No orders found for this user.</td></tr>";
                }
            
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
