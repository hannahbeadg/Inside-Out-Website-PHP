<!DOCTYPE html>
<?php
include("conn.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    mysqli_query($conn, "INSERT INTO tbl_messages
    (
        message_name,
        message_email,
        message_text,
        created_at
    )
    VALUES
    (
        '$name',
        '$email',
        '$message',
        NOW()
    )");

    header("Location: INSIDEOUT-Contact.php?sent=1");
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inside Out | Contact</title>

    <link rel="icon" type="image/x-icon" href="InsideOutImages/IconLogo.PNG">
    <link rel="stylesheet" href="STYLE-Contact.css">
    <link rel="stylesheet" href="footer.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto&family=Patrick+Hand&display=swap" rel="stylesheet">
</head>

<body>

<div class="nav-bar">
    <div class="disney-logo">
        <a href="https://www.apps.disneyplus.com/" target="_blank">
            <img src="InsideOutImages/DisneyPlusLogo.PNG" alt="DisneyPlus Logo">
        </a>
    </div>

    <nav class="nav">
        <a href="index.php">Home</a>   
        <a href="INSIDEOUT-About.php">About</a>
        <a href="INSIDEOUT-Emotions.php">Emotions</a>
        <a href="INSIDEOUT-Watch.php">Watch</a>
        <a href="INSIDEOUT-Contact.php" class="active">Contact</a>
    </nav>
</div>

<div class="main-characters">
    <img src="InsideOutImages/Characters2.PNG" alt="Inside Out Characters">
</div>

<div class="content">

    <div class="form-table">

        <?php if(isset($_GET['sent'])) { ?>
            <script>
                alert("Message sent successfully!");
            </script>
        <?php } ?>

        <form method="POST">

            <h2>Contact Us</h2>
            <p class="subtitle">Fill out the form below and we’ll get back to you soon.</p>

            <table>

                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Your Name" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="email" name="email" placeholder="Your Email" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <textarea name="message" placeholder="Your Message" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Send Message">
                    </td>
                </tr>

            </table>

        </form>

    </div>

</div>

<?php include("footer.html"); ?>
<script src="JS_Contact.js"></script>

</body>
</html>