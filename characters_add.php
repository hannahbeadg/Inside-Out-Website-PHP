<!DOCTYPE html>
<html>
<head>
    <title>Add Character</title>

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

        $emotion_id = $_POST['emotion_id'];
        $character_name = $_POST['character_name'];
        $character_role = $_POST['character_role'];
        $character_description = $_POST['character_description'];

        $character_image = $_FILES['character_image']['name'];
        $temp_name = $_FILES['character_image']['tmp_name'];

        move_uploaded_file($temp_name, "uploads/" . $character_image);

        mysqli_query(
            $conn,
            "INSERT INTO tbl_characters (
                emotion_id,
                character_name,
                character_role,
                character_image,
                character_description,
                updated_at
            ) VALUES (
                '$emotion_id',
                '$character_name',
                '$character_role',
                '$character_image',
                '$character_description',
                NOW()
            )"
        );

        $_SESSION['status'] = "Character Successfully Added!";
        header("Location: admincharacters.php");
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
        Add Character
    </h2>

    <div class="card form-card p-4">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">

                <label class="form-label">
                    Emotion
                </label>

                <select name="emotion_id"
                        class="form-select"
                        required>

                    <option value="">
                        Select Emotion
                    </option>

                    <?php
                        $emotion_query = mysqli_query($conn, "SELECT * FROM tbl_emotions");

                        while ($emotion = mysqli_fetch_array($emotion_query)) {
                    ?>

                    <option value="<?php echo $emotion['emotion_id']; ?>">
                        <?php echo $emotion['emotion_name']; ?>
                    </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Character Name
                </label>

                <input type="text"
                       name="character_name"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Character Role
                </label>

                <input type="text"
                       name="character_role"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Character Image
                </label>

                <input type="file"
                       name="character_image"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea name="character_description"
                          class="form-control"
                          rows="5"
                          required></textarea>

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

                <a href="admincharacters.php"
                   class="btn btn-dark">
                    BACK
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>