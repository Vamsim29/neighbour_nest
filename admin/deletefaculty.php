<?php 
require '../vendor/autoload.php';
//function to deactivate account
function deactivateAccount($client, $userId, $password)
{
    $collection = $client->communihelp->basiclogin;

    $updateResult = $collection->updateOne(
        ['data.userid' => $userId],
        [
            '$set' => [
                'data.$.username' => 'DEACTIVATED',
                'data.$.password' => $password,
            ],
        ]
    );

    return $updateResult->getModifiedCount() > 0;
}
    //Include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of student to be deleted
    $id = $_GET['id'];

    //2.create some random integer value to set as password
    $randomNumber = rand(1, 100000000); // Generates a random number between 1 and 100,000,000

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    // Check whether the query executed successfully or not
    if(deactivateAccount($mongoClient, $id,$randomNumber))
    {
        //Query Executed Successully and Admin Deleted
        //echo "Student Deleted";
        //Create SEssion Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Room Deactivated Successfully.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/managefaculty.php');
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Deactivate. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/managefaculty.php');
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>