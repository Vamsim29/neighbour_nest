<?php
include("stdheader.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stylish Buttons</title>
  <style>
    .conatiner {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 72vh;
      background-color: #f4f4f4;
    }
    
    .button {
      width: 320px;
      height: 220px;
      border-radius: 10px;
      background-color: #e2ff07;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 10px 10px;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #e460d5;
    }

    .button img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .button h2 {
      color: #f02009;
      font-size: 18px;
      text-align: center;
      margin: 0;
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
        <h1>Requests</h1>
    </div>
    <div class="conatiner">
  <div class="button" onclick="gotodonationpage()">
    <img src="inbox.jpg" alt="Image 1">
    <h2>Inbox Requests</h2>
  </div>
  <div class="button" onclick="gotorequestspage()">
    <img src="donate.jpg" alt="Image 2">
    <h2>Your Requests</h2>
  </div>
    </div>
    <script>
      function gotodonationpage(){
        const url = `inboxrequests.php`;
            window.location.href = url;
      }
      function gotorequestspage(){
        const url = `yourrequests.php`;
            window.location.href = url;
      }
    </script>
</body>
</html>
