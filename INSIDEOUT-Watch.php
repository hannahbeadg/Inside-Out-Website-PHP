<?php
include("conn.php");

$query = mysqli_query($conn, "
    SELECT * FROM tbl_watch
    ORDER BY display_order ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Inside Out | Watch
    </title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-Watch.css">
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
        <a href="INSIDEOUT-Emotions.php">Emotions</a>
        <a href="INSIDEOUT-Watch.php" class="active">Watch</a>
        <a href="INSIDEOUT-Contact.php">Contact</a>
    </nav>
</div>

<main class="watch-content">

    <section class="watch-title">

        <h2>
            Trailers
        </h2>

    </section>

    <section class="trailers">

        <?php
        while($row = mysqli_fetch_assoc($query)) {

            $video_title = $row['video_title'];
            $video_link = $row['video_link'];
            $watchbutton_link = $row['watchbutton_link'];

            /* convert youtube link to embed */
            parse_str(parse_url($video_link, PHP_URL_QUERY), $youtube_params);

            $video_id = '';

            if(isset($youtube_params['v'])) {

                $video_id = $youtube_params['v'];

            } else {

                $path = parse_url($video_link, PHP_URL_PATH);
                $video_id = trim($path, '/');

            }

            $embed_link = "https://www.youtube.com/embed/" . $video_id;
        ?>

        <div class="trailer-box">

            <iframe src="<?php echo $embed_link; ?>"
                    title="<?php echo $video_title; ?>"
                    allowfullscreen>

            </iframe>

            <h3>
                <?php echo $video_title; ?>
            </h3>

            <a class="watch-button"
               href="<?php echo $watchbutton_link; ?>"
               target="_blank">

                Watch Full Movie

            </a>

        </div>

        <?php } ?>

    </section>

</main>

<?php include("footer.html"); ?>

</body>
</html>