<?php

include("conn.php");

$query = mysqli_query($conn, "
    SELECT * FROM tbl_emotions
    ORDER BY display_order ASC
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Inside Out | Emotions</title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-Emotions.css">
    <link rel="stylesheet" href="footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto&family=Patrick+Hand&display=swap" rel="stylesheet">

</head>

<body>

<div class="nav-bar">
    <div class="disney-logo">
        <a href="https://www.apps.disneyplus.com/" target="_blank" rel="noopener">
            <img src="InsideOutImages/DisneyPlusLogo.PNG" alt="DisneyPlus Logo">
        </a>
    </div>

    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="INSIDEOUT-About.php">About</a>
        <a href="INSIDEOUT-Emotions.php" class="active">Emotions</a>
        <a href="INSIDEOUT-Watch.php">Watch</a>
        <a href="INSIDEOUT-Contact.php">Contact</a>
    </nav>
</div>

<section class="emotions-section">

    <h2>Meet the Emotions</h2>

    <div class="emotions-slide">

        <button class="arrow left">

            &#10094;

        </button>

        <div class="slider">

            <?php
            while($row = mysqli_fetch_assoc($query)) {

                $emotion_id = $row['emotion_id'];
                $emotion_name = $row['emotion_name'];
                $emotion_image = $row['emotion_image'];
            ?>

                <div class="emotion-card">

                    <a href="INSIDEOUT-Character.php?id=<?php echo $emotion_id; ?>">

                        <?php if(!empty($emotion_image)) { ?>

                            <img src="uploads/<?php echo $emotion_image; ?>"
                                 alt="<?php echo $emotion_name; ?>">

                        <?php } ?>

                    </a>

                </div>

            <?php } ?>

        </div>

        <button class="arrow right">

            &#10095;

        </button>

    </div>

</section>

<?php include("footer.html"); ?>

<script src="JS_Emotions.js"></script>

</body>
</html>