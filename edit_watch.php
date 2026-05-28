<!DOCTYPE html>
<html>
<head>
    <title>Edit Watch</title>

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
    $watch_id = (int) $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $video_title = $_POST['video_title'];
        $video_link = $_POST['video_link'];
        $watchbutton_link = $_POST['watchbutton_link'];
        $display_order = $_POST['display_order'];

        mysqli_query(
            $conn,
            "UPDATE tbl_watch SET
                video_title='$video_title',
                video_link='$video_link',
                watchbutton_link='$watchbutton_link',
                display_order='$display_order',
                updated_at=NOW()
            WHERE watch_id='$watch_id'"
        );

        $_SESSION['status'] = "Watch Video Successfully Updated!";
        header("location: adminwatch.php");
        exit();
    }

    $query = mysqli_query($conn, "SELECT * FROM tbl_watch WHERE watch_id='$watch_id'");
    $row = mysqli_fetch_array($query);

    $video_title = $row['video_title'];
    $video_link = $row['video_link'];
    $watchbutton_link = $row['watchbutton_link'];
    $display_order = $row['display_order'];
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
        Edit Watch Video
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
                       value="<?php echo $video_title; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Video Link
                </label>

                <input type="text"
                       name="video_link"
                       class="form-control"
                       value="<?php echo $video_link; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Watch Button Link
                </label>

                <input type="text"
                       name="watchbutton_link"
                       class="form-control"
                       value="<?php echo $watchbutton_link; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Display Order
                </label>

                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="<?php echo $display_order; ?>"
                       required>

            </div>

            <div class="form-buttons">

                <div class="left-buttons">

                    <input type="submit"
                           class="btn btn-success"
                           value="UPDATE">

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