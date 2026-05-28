<!DOCTYPE html>
<html>
<head>
    <title>Add Emotion</title>

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

        $emotion_name = $_POST['emotion_name'];
        $display_order = $_POST['display_order'];

        $emotion_image = $_FILES['emotion_image']['name'];
        $temp_name = $_FILES['emotion_image']['tmp_name'];

        move_uploaded_file($temp_name, "uploads/" . $emotion_image);

        mysqli_query(
            $conn,
            "INSERT INTO tbl_emotions (
                emotion_name,
                emotion_image,
                display_order,
                updated_at
            ) VALUES (
                '$emotion_name',
                '$emotion_image',
                '$display_order',
                NOW()
            )"
        );

        $_SESSION['status'] = "Emotion Successfully Added!";
        header("Location: adminemotions.php");
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
        Add Emotion
    </h2>

    <div class="card form-card p-4">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">

                <label class="form-label">
                    Emotion Name
                </label>

                <input type="text"
                       name="emotion_name"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Emotion Image
                </label>

                <input type="file"
                       name="emotion_image"
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

                <a href="adminemotions.php"
                   class="btn btn-dark">
                    BACK
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>