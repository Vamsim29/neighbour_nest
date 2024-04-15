<?php
include("stdheader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Donations And Requests Page</title>
  <style>
     
    .bodyone {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 65vh;
      position: relative;
      overflow: hidden;
    }
    
    .button {
      width: 320px;
      height: 220px;
      border-radius: 10px;
      background-color: #3498db;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 10px;
      transition: background-color 0.3s ease, transform 0.2s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .button:hover {
      background-color: #2980b9;
      transform: translateY(-5px);
    }

    .button::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.5));
      z-index: 1;
      transition: opacity 0.3s ease;
      opacity: 0;
      pointer-events: none;
    }

    .button:hover::before {
      opacity: 1;
    }

    .button img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      z-index: 2;
      transition: transform 0.3s ease;
    }

    .button:hover img {
      transform: scale(1.1);
    }

    .button h2 {
      color: #fff;
      font-size: 18px;
      text-align: center;
      margin: 0;
      z-index: 2;
      position: relative;
    }
    h1{
        text-align: center;
        color: #1676eb;
            margin-bottom: 20px;
            font-family: 'Poppins', Arial, sans-serif; /* Apply Poppins to headings */
            font-weight: 600;
        }
  </style>
</head>
<body>
  <div class="heading"><!-- need to be at the center of the page -->
         <br>
        <h1>Donations & Requests</h1>
    </div>
  <div class="bodyone">
  <div class="button" onclick="gotodonationpage()">
    <img src="request.jpg" alt="Image 1">
    <h2>Donations</h2>
  </div>
  <div class="button" onclick="gotorequestspage()">
    <img src="donate.jpg" alt="Image 2">
    <h2>Requests</h2>
  </div>
  </div>
  <script>
    function gotodonationpage(){
      const url = `donationspage.php`;
      window.location.href = url;
    }
    function gotorequestspage(){
      const url = `requestspage.php`;
      window.location.href = url;
    }
  </script>
</body>
</html>
