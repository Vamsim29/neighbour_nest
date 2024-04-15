<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Neighbour Nest-Admin Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../hello.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet"> 
</head>

<body>
      <?php 
      if (isset($_SESSION['login'])) {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }

      if (isset($_SESSION['no-login-message'])) {
          echo $_SESSION['no-login-message'];
          unset($_SESSION['no-login-message']);
      }
      ?>
      <div class="one">
        <img src="../logocommuni.png" alt="Neighbours" width="200" height="200">
        <h1 style="color: white; font-family: 'Poppins', sans-serif  ;font-size: 3.5rem;" >NeighbourNest</h1>
    </div>
    <div class="two">
        <h3 style="text-align: center; font-family: 'Poppins', sans-serif; font-size: 2rem; color: blueviolet;">Admin Login</h3>
        <form method="POST" action="">
        <label>AdminId</label><br>
        <input type="text" name="userid" ><br><br>
        <label>Password</label><br>
        <input type="password" name="password" ><br><br>
        <input type="submit" name="submit" value="Login" class="button"><br><br>
        </form>
        <a href="../index.html"><button class="button" style="float: right;">User Login</button></a>
    </div>
</body>
</html>

<?php 

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {
    //Process for Login
    //1. Get the Data from Login form
    // $username = $_POST['username'];
    // $password = md5($_POST['password']);
    require '../vendor/autoload.php';
    //$username = mysqli_real_escape_string($conn, $_POST['userid']);
    $username = $_POST['userid'];

    $password = $_POST['password'];

    //echo $username;
    //echo $password;
    //$password = mysqli_real_escape_string($conn, $raw_password);

    // Connection to MongoDB
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $mongoClient->communihelp->admintable;

    // Query MongoDB using $elemMatch to match elements within the 'data' array
    $result = $collection->findOne(['data' => ['$elemMatch' => ['adminid' => $username, 'password' => $password]]]);

    if ($result) {
        //User Available and Login Success
        $_SESSION['login'] = "<div class='success'>Login.</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

        //Redirect to Home Page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        //User not Available and Login Fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //Redirect to Home Page/Dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>
