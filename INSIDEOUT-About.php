<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inside Out | About</title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-About.css">
    <link rel="stylesheet" href="footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto&family=Patrick+Hand&display=swap" rel="stylesheet">

    <?php
    include("conn.php");
    ?>
</head>

<body>

<?php
$page_id = 10;

$query = mysqli_query($conn, "
    SELECT * FROM tbl_content
    WHERE page_id = $page_id
    ORDER BY display_order ASC
");
?>

<div class="nav-bar">
    <div class="disney-logo">
        <a href="https://www.apps.disneyplus.com/" target="_blank" rel="noopener">
            <img src="InsideOutImages/DisneyPlusLogo.PNG" alt="DisneyPlus Logo">
        </a>
    </div>

    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="INSIDEOUT-About.php" class="active">About</a>
        <a href="INSIDEOUT-Emotions.php">Emotions</a>
        <a href="INSIDEOUT-Watch.php">Watch</a>
        <a href="INSIDEOUT-Contact.php">Contact</a>
    </nav>
</div>

<main class="about-content">

<?php
$index = 0;

while($row = mysqli_fetch_array($query)) {

    $title = $row['title'];
    $description = $row['description'];
    $image = $row['image'];

    // alternate direction
    $reverseClass = ($index % 2 == 1) ? "reverse" : "";
?>

    <section class="about-section <?php echo $reverseClass; ?>">

        <div class="about-text">

            <?php if(!empty($title)) { ?>
                <h2><?php echo $title; ?></h2>
            <?php } ?>

            <p><?php echo $description; ?></p>

        </div>

        <div class="about-image">
            <img src="uploads/<?php echo $image; ?>" alt="<?php echo $title; ?>">
        </div>

    </section>

<?php
    $index++;
}
?>

</main>

<?php include("footer.html"); ?>

<script src="JS_About.js"></script>

</body>
</html>