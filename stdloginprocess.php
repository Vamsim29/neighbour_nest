<?php
require 'vendor/autoload.php';

$usid = $_POST['userid'];
$uspas = $_POST['password'];

// Setting up the cookie to retrieve it in vamsi.php
setcookie("varus_name", $usid, time() + 3600);

// Connection to MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$collection = $mongoClient->communihelp->basiclogin;

// Query MongoDB using $elemMatch to match elements within the 'data' array
$result = $collection->findOne(['data' => ['$elemMatch' => ['userid' => $usid, 'password' => $uspas]]]);

if ($result) {
    // User found, redirect to stdhome.php
    header("Location: stdhome.php");
} else {
    // User not found, display error message and redirect to index.html
    echo "<script> alert('Username and password are incorrect for login');
    location.href = 'index.html';
    </script>";
}
?>
