<!DOCTYPE html>
<html>
<head>
    <title>Add Watch Video</title>

    <?php
        include("session.php");
        include("conn.php");
        include("css.php");
        include("js.php");
        $admin_username = $_SESSION['admin_username'];
    ?>

    <link rel="stylesheet" href="cssbackend.css">
</head>

<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $video_title = $_POST['video_title'];
        $video_link = $_POST['video_link'];
        $watchbutton_link = $_POST['watchbutton_link'];
        $display_order = $_POST['display_order'];

        mysqli_query(
            $conn,
            "INSERT INTO tbl_watch (
                video_title,
                video_link,
                watchbutton_link,
                display_order,
                updated_at
            ) VALUES (
                '$video_title',
                '$video_link',
                '$watchbutton_link',
                '$display_order',
                NOW()
            )"
        );

        $_SESSION['status'] = "Video Successfully Added!";
        header("Location: adminwatch.php");
        exit();
    }
?>

<div class="topbar">

    <a href="dashboard.php">
        <img src="InsideOutImages/InsideOutWordLogo.png" height="40" alt="Inside Out">
    </a>

    <div>
        <a href="adminprofile.php"
            class="admin-profile-link" style="text-decoration:none !important; color:#1f2937 !important; font-weight:500;">
            <i class="fa-solid fa-user"></i>
            <?php echo $admin_username; ?>
        </a>
    </div>

</div>

<div class="sidebar">

    <div class="sidebar-top">

        <div class="sidebar-title">
            Content and Modules
        </div>

        <a href="admindashboard.php">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <a href="admincontent.php">
            <i class="fa-solid fa-file-lines"></i> Content
        </a>

        <a href="adminemotions.php">
            <i class="fa-solid fa-face-smile"></i> Emotions
        </a>

        <a href="admincharacters.php">
            <i class="fa-solid fa-user"></i> Characters
        </a>

        <a href="adminwatch.php">
            <i class="fa-solid fa-video"></i> Watch
        </a>

        <a href="adminmessages.php">
            <i class="fa-solid fa-envelope"></i> Messages
        </a>

    </div>

    <div class="sidebar-bottom">

        <a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>

    </div>

</div>

<div class="main">

    <h2 class="page-title">
        Add Watch Video
    </h2>

    <div class="card form-card p-4">

        <form method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Video Title
                </label>

                <input type="text"
                       name="video_title"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Video Link
                </label>

                <input type="text"
                       name="video_link"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Watch Button Link
                </label>

                <input type="text"
                       name="watchbutton_link"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Display Order
                </label>

                <input type="number"
                       name="display_order"
                       class="form-control"
                       required>

            </div>

            <div class="form-buttons">

                <div class="left-buttons">

                    <input type="submit"
                           class="btn btn-success"
                           value="ADD">

                    <input type="reset"
                           class="btn btn-secondary"
                           value="CLEAR">

                </div>

                <a href="adminwatch.php" class="btn btn-dark">
                    BACK
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>