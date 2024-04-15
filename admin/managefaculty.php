<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .main-content {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            margin-top: 0;
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: 1px solid #6c757d;
        }

        .btn-danger {
            background-color: #dc3545;
            border: 1px solid #dc3545;
        }

        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-danger:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .one{
            color: #007bff;
            background-color: #f2f2f2;
        }
        .two{
            color: green;
            background-color: #f2f2f2;
        }
        .three{
            color: red;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
</body>
</html>
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <br>
                <h1>Manage Home's</h1>
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //REmoving Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br>

                <!-- Button to Add Admin -->
                <a href="addfaculty.php" class="btn-primary">Add New Room</a>

                <table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Room Id</th>
                        <th>User Name</th>
                        <th>Actions</th>
                    </tr>

                    
                    <?php
                        require '../vendor/autoload.php';
                        //collecting the data from the database
                        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                        $collection = $mongoClient->communihelp->basiclogin; 
                        // Query to find documents 
                        $result = $collection->find(); 
                        
                        $sn = 1; // Create a Serial Number and set its initial value as 1
                        //CHeck whether the Query is Executed of Not
                        if (!empty($result)) {
                    foreach ($result as $document) {
                    foreach ($document['data'] as $rows) {
                                    //Using While loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual DAta
                                    $id=$rows['userid'];
                                    $username=$rows['username'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/updatefacpassword.php?id=<?php echo $id; ?>" class="btn btn-secondary one">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/updatefaculty.php?id=<?php echo $id; ?>" class="btn btn-secondary two">Update Room</a>
                                            <a href="<?php echo SITEURL; ?>admin/deletefaculty.php?id=<?php echo $id; ?>" class="btn btn-secondary three">Deactivate Room</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                           
                        }
                        else{
                            echo "No Data Avaialabe";
                        }

                    ?>


                    
                </table>

            </div>
        </div>
        <!-- Main Content Setion Ends -->
</body>
</html>