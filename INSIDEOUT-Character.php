<?php
include("conn.php");

if (!isset($_GET['id'])) {
    header("location: INSIDEOUT-Emotions.php");
    exit();
}

$emotion_id = (int) $_GET['id'];

$query = mysqli_query($conn, "
    SELECT * FROM tbl_characters
    WHERE emotion_id = $emotion_id
    LIMIT 1
");

$row = mysqli_fetch_assoc($query);

if (!$row) {
    echo "Character not found.";
    exit();
}

$order_query = mysqli_query($conn, "
    SELECT display_order
    FROM tbl_emotions
    WHERE emotion_id = $emotion_id
    LIMIT 1
");

$order_row = mysqli_fetch_assoc($order_query);

$current_order = $order_row['display_order'];

$prev_query = mysqli_query($conn, "
    SELECT emotion_id
    FROM tbl_emotions
    WHERE display_order > $current_order
    ORDER BY display_order ASC
    LIMIT 1
");

$prev = mysqli_fetch_assoc($prev_query);

if (!$prev) {

    $prev_query = mysqli_query($conn, "
        SELECT emotion_id
        FROM tbl_emotions
        ORDER BY display_order ASC
        LIMIT 1
    ");

    $prev = mysqli_fetch_assoc($prev_query);
}

$next_query = mysqli_query($conn, "
    SELECT emotion_id
    FROM tbl_emotions
    WHERE display_order < $current_order
    ORDER BY display_order DESC
    LIMIT 1
");

$next = mysqli_fetch_assoc($next_query);

if (!$next) {

    $next_query = mysqli_query($conn, "
        SELECT emotion_id
        FROM tbl_emotions
        ORDER BY display_order DESC
        LIMIT 1
    ");

    $next = mysqli_fetch_assoc($next_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Inside Out | <?php echo $row['character_name']; ?>
    </title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-Characters.css">
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

<section class="emotion-detail">

    <a class="arrow left"
       href="INSIDEOUT-Character.php?id=<?php echo $prev['emotion_id']; ?>">

        &#10094;

    </a>

    <div class="emotion-img">

        <?php if(!empty($row['character_image'])) { ?>

            <img src="uploads/<?php echo $row['character_image']; ?>"
                 alt="<?php echo $row['character_name']; ?>">

        <?php } ?>

    </div>

    <div class="emotion-box">

        <a href="INSIDEOUT-Emotions.php" class="back-button"> ← Back to Emotions</a>

        <h1 class="character-<?php echo strtolower($row['character_name']); ?>">
            <?php echo $row['character_name']; ?>
        </h1>

        <h3>
            <?php echo $row['character_role']; ?>
        </h3>

        <p>
            <?php echo $row['character_description']; ?>
        </p>

    </div>

    <a class="arrow right" href="INSIDEOUT-Character.php?id=<?php echo $next['emotion_id']; ?>">

        &#10095;

    </a>

</section>

<?php include("footer.html"); ?>

</body>
</html>