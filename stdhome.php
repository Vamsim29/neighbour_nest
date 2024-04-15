<?php include("stdheader.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        /* Resetting default margin for body and h3 */
body {
    margin: 0;
}

h3 {
    margin-top: 0;
}

/* Style for content */
.content {
    display: flex;
    flex-direction: column;
    align-items: center; /* Optional: centers content horizontally */
    padding: 1rem; /* Optional: Adds space around content */
}
    </style>
</head>
<body>
    <div class="content">
        <?php include("calender.php"); ?>
    </div>
</body>
</html>
