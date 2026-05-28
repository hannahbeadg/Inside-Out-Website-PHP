<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inside Out</title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-Home.css">
    <link rel="stylesheet" href="footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto&family=Patrick+Hand&display=swap" rel="stylesheet">
</head>

<body>

<?php
require_once "conn.php";

$query = mysqli_query($conn, "SELECT * FROM tbl_content WHERE page_id = 1 LIMIT 1");
$home = mysqli_fetch_assoc($query);
?>


    <div class="nav-bar">

        <div class="disney-logo">
            <a href="https://www.apps.disneyplus.com/" target="_blank" rel="noopener">
                <img src="InsideOutImages/DisneyPlusLogo.PNG" alt="DisneyPlus Logo">
            </a>
        </div>

        <nav class="nav">
            <a href="index.php" class="active">Home</a>   
            <a href="INSIDEOUT-About.php">About</a>
            <a href="INSIDEOUT-Emotions.php">Emotions</a>
            <a href="INSIDEOUT-Watch.php">Watch</a>
            <a href="INSIDEOUT-Contact.php">Contact</a>
        </nav>

    </div>

    <section class="main">

        <div class="main-text">

            <a href="index.php">
                <img src="InsideOutImages/InsideOutLogoWhite.PNG" alt="Inside Out Logo" class="insideout-logo">
            </a>

            <h1>
                <?php echo $home['title']; ?>
            </h1>

            <p>
                <?php echo $home['description']; ?>
            </p>

            <a href="INSIDEOUT-About.php">
                <button>Learn More</button>
            </a>

        </div>

        <div class="main-characters">

            <img src="InsideOutImages/<?php echo $home['image']; ?>" 
                 alt="Inside Out Characters">

        </div>

    </section>

    <?php include("footer.html"); ?>

</body>
</html>