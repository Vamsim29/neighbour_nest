<?php 
include('partials/menu.php');
require '../vendor/autoload.php';
function updatePassword($client, $userId, $password)
{
    $collection = $client->communihelp->basiclogin;

    $updateResult = $collection->updateOne(
        ['data.userid' => $userId],
        [
            '$set' => [
                'data.$.password' => $password,
            ],
        ]
    );

    return $updateResult->getModifiedCount() > 0;
}
            //CHeck whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //echo "CLicked";

                //1. Get the DAta from Form
                $id=$_POST['id'];
                $new_password = $_POST['new_password'];
                $confirm_password =$_POST['confirm_password'];
                // Usage example
                $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
                        //Check whether the new password and confirm match or not
                        if($new_password==$confirm_password)
                        {
                            
                            //CHeck whether the query exeuted or not
                            if(updatePassword($mongoClient, $id,$new_password))
                            {
                                //Display Succes Message
                                //REdirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/managefaculty.php');
                            }
                            else
                            {
                                //Display Error Message
                                //REdirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/managefaculty.php');
                            }
                        }
                        else
                        {
                            //REdirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                            //Redirect the User
                            header('location:'.SITEURL.'admin/managefaculty.php');

                        }
                    

                //3. CHeck Whether the New Password and Confirm Password Match or not

                //4. Change PAssword if all above is true
            }
?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(to bottom right, #f2fcff, #d6eaf8);
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
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
            color: #333;
            border-bottom: 2px solid #f7b5c5;
            padding-bottom: 10px;
        }

        form {
            margin-top: 20px;
        }

        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 12px 20px;
            margin-bottom: 10px;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: #d6eaf8;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            color: #333;
            transition: 0.3s;
        }

        input[type="password"]:hover {
            box-shadow: 0px 2px 5px rgba(247, 181, 197, 0.2);
        }

        input[type="submit"] {
            background: linear-gradient(to bottom right, #fff, #f5faff);
            color: #333;
            font-weight: 500;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #f7b5c5;
            color: #fff;
        }

        .hidden-password {
            display: none;
        }

        .eye-icon {
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
         <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" placeholder="New Password">
                <i class="fas fa-eye eye-icon hidden-password"></i>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                <i class="fas fa-eye eye-icon hidden-password"></i>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Password">
        </form>

    </div>
</div>