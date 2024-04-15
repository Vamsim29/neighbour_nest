<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!--javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <style>
.navbutton{
  font-family: 'Saira Semi Condensed', sans-serif;
  display: block;
  margin: 6px 2px;
  padding: 2px 2px;
  border-width:1px;
  border-width: 5px !important;
  border-color: white !important;
  background-color: white;
  color: #244065;
  border-color:#ffffff;
  font-weight:bold;
  border-radius: 6px;
  box-shadow:inset 0px 1px 0px 0px #f29c93;
  text-shadow:inset 0px 1px 0px #b23e35;
  
}
.navbutton:hover{
  color: black;
  background-color: yellow;
}
    </style>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="padding:0 8px; background-color:#244065;">
        <a class="navbar-brand" href="">
          <img  src="logocommuni.png" alt="logo" height="35" width="45" style="margin:1rem 2rem;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link navbutton" href="stdhome.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="stdprofile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="userstore.php">Store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="userservice.php">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="userdonreq.php">Donations&Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="userhistory.php">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbutton" href="index.html">Logout</a>
            </li>
        </ul>
        </div>
    </nav>    
</body>
</html>