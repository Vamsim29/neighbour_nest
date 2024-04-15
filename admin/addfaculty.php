<?php 

include('partials/menu.php'); 
require '../vendor/autoload.php';
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$collection = $mongoClient->communihelp->basiclogin;
   //Process the Value from Form and Save it in Database
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $username = $_POST['name'];
        $facid = $_POST['stdid'];
        $contact = $_POST['contact'];
        $date = $_POST['dob'];
        $mail = $_POST['email']; 

        //make up the data as doument
        $data= [
        "username" => $username,
        "userid" => $facid,
        "password" => 'welcome',
        "mobileno" => $contact,
        "dob" => $date,
        "email" => $mail
        ];
 
        // 3.Update the existing document in the collection
        $updateResult = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID('65c07609fb4b81a1bc9309b1')],
        ['$push' => ['data' => $data]]
        );

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($updateResult->getModifiedCount() > 0)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Faculty Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/managefaculty.php');
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Faculty.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/addfacultly.php');
        }

    }
    
?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f7f9fc;
            color: #333;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .wrapper {
            width: 400px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 5px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 12px 20px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5faff;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="text"]:hover,
        input[type="date"]:hover {
            border-color: #95a5b5;
        }

        input[type="submit"] {
            background: #2196f3;
            color: white;
            font-weight: 500;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #1976d2;
        }
    </style>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Room</h1>

        <br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" >
                    </td>
                </tr>
                <tr>
                    <td>Room Id: </td>
                    <td>
                        <input type="text" name="stdid" >
                    </td>
                </tr>

                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="text" name="contact" >
                    </td>
                </tr>
                <tr>
                    <td>Date Of Birth: </td>
                    <td>
                        <input type="date" name="dob" >
                    </td>
                </tr>
                <tr>
                    <td>E-Mail: </td>
                    <td>
                        <input type="text" name="email" >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Room" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>