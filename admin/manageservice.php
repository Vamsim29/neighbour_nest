<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #6c5ce7;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-weight: 500;
            font-size: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #dfe6e9;
            font-weight: 500;
        }

        select,
        input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-color: #6c5ce7;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4a3f9a;
        }

        /* Highlighting fields */
        select:focus,
        select:hover,
        input[type="submit"]:focus,
        input[type="submit"]:hover,
        input[type="text"]:focus,
        input[type="text"]:hover {
            outline: none;
            box-shadow: 0 0 5px #6c5ce7;
        }

        .error {
            color: red;
            font-weight: 500;
        }

        /* Customizing alternate rows */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        /* Added styles for scrollability */
        .table-container {
            max-height: 600px; /* Set the maximum height you prefer */
            overflow-y: auto;
        }
    </style>
</head>
<body>
<?php include('partials/menu.php'); 
require '../vendor/autoload.php';
 //start updating order status  
            //CHeck whether Update Button is Clicked or Not

            function updateServiceData($client,$idema,$usfood,$usdate,$stat)
                {
                    $coll = $client->communihelp->servicestore;
                    // echo $idema;echo $usfood;echo $usdate;echo $stat;
                    // 'data.roomid' => $idema ,'data.service' => $usfood;
                    $updateResult = $coll->updateOne(
                    ['data.datetime' => $usdate,'data.roomid' => $idema ,'data.service' => $usfood ],
                    [
                        '$set' => [
                        'data.$.status' => $stat,
                    ],
                    ]
                    );
                    return $updateResult->getModifiedCount() > 0;
                }

            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $idema = $_POST['useremailll'];
                $usfood= $_POST['userfooddd'];
                $usdate= $_POST['userdateee'];
                $status = $_POST['statusuu'];
                $mC = new MongoDB\Client("mongodb://localhost:27017");
                if(updateServiceData($mC,$idema,$usfood,$usdate,$status))
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    //header('location:'.SITEURL.'admin/manageservice.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    //header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            // end 
?>
<div class="main-content">
    <div class="wrapper" style="padding: 0 10%;">
        <br>
        <h1>Manage Services</h1>
        <br>
        <?php 
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <div class="table-container">
        <table>
            <tr>
                <th>Room Id</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Actions</th>
                <th>Clicktoupdate</th>
            </tr>

                <?php
                //collecting the data from the database
                $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $mongoClient->communihelp->servicestore; 
                // Query to find documents 
                $result = $collection->find(); 
                
                $sn = 1; // Create a Serial Number and set its initial value as 1

                if (!empty($result)) {
                    foreach ($result as $document) {
                    foreach ($document['data'] as $row) {
                        // Get all the order details
                        $customer_email = $row['roomid'];
                        $food = $row['service'];
                        $order_date = $row['datetime'];
                        $status = $row['status'];
                        $customer_name = $row['name'];
                        $customer_contact = $row['mblno'];
                        ?>

                        <tr>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td>
                                <?php 
                                    // Ordered, On Delivery, Delivered, Cancelled
                                    if($status=="booked" or $status=="Booked")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status=="Accepted")
                                    {
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    elseif($status=="completed" or $status=="Completed")
                                    {
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <form action="" method="POST">
                                <td>
                                    <select name="statusuu">
                                        <option <?php if($status=="Booked"){echo "selected";} ?> value="Booked">Booked</option>
                                        <option <?php if($status=="Accepted"){echo "selected";} ?> value="Accepted">Accepted</option>
                                        <option <?php if($status=="Completed"){echo "selected";} ?> value="Completed">Completed</option>
                                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                                    </select>
                                </td>
                                <td><input type="submit" name="submit" value="UPDATE" class="btn-primary"></td>
                                <input type="hidden" name="useremailll" value="<?php echo $customer_email; ?>">
                                <input type="hidden" name="userfooddd" value="<?php echo $food; ?>">
                                <input type="hidden" name="userdateee" value="<?php echo $order_date; ?>">
                            </form>
                        </tr>
                                               
                        <?php
                    }
                 } // closing brace for the while loop
                }
                else
                {
                    // Order not Available
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>
            

        </table>
        </div>
    </div>
</div>
</body>
</html>
