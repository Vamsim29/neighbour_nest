<?php include('partials/menu.php');
require '../vendor/autoload.php';
function updateUser($client,$id, $username, $contact,$date,$mail)
{
    $collection = $client->communihelp->basiclogin;

    $updateResult = $collection->updateOne(
        ['data.userid' => $id],
        [
            '$set' => [
                'data.$.username' => $username,
                'data.$.mobileno' => $contact,
                'data.$.dob' => $date,
                'data.$.email' => $mail,
            ],
        ]
    );

    return $updateResult->getModifiedCount() > 0;
} 
 //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $username = $_POST['name'];
        $contact = $_POST['contact'];
        $date = $_POST['dob'];
        $mail = $_POST['email'];
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017"); 

        //MongoDB function to update the data of the user
        //Check whether the query executed successfully or not
        if(updateUser($mongoClient, $id, $username, $contact, $date, $mail))
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Student Details Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/managefaculty.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/managefaculty.php');
        }
    }

?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0 0 0 0;
            padding: 0;
            background-color: #f2f5f9;
            color: #333;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #5f9ea0;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 6px 0;
        }

        input[type="text"],
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"] {
            background-color: #5f9ea0;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #468284;
        }

        /* Highlighting fields */
        input[type="text"]:focus,
        input[type="text"]:hover,
        input[type="submit"]:focus,
        input[type="submit"]:hover {
            outline: none;
            box-shadow: 0 0 5px #5f9ea0;
        }
    </style>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Room Member Details</h1>
        


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" >
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
                        <input type="text" name="dob" >
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>