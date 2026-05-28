<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>

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
    $content_id = (int) $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $page_id = $_POST['page_id'];
        $title = trim($_POST['title']);
        $description = $_POST['description'];
        $display_order = $_POST['display_order'];

        $title = ($title === "") ? NULL : $title;

        if (!empty($_FILES['image']['name'])) {

            $new_image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            move_uploaded_file($tmp_name, "uploads/" . $new_image);

            mysqli_query(
                $conn,
                "UPDATE tbl_content SET
                    page_id='$page_id',
                    title=" . ($title ? "'$title'" : "NULL") . ",
                    description='$description',
                    image='$new_image',
                    display_order='$display_order',
                    updated_at=NOW()
                WHERE content_id='$content_id'"
            );

        } else {

            mysqli_query(
                $conn,
                "UPDATE tbl_content SET
                    page_id='$page_id',
                    title=" . ($title ? "'$title'" : "NULL") . ",
                    description='$description',
                    display_order='$display_order',
                    updated_at=NOW()
                WHERE content_id='$content_id'"
            );
        }

        $_SESSION['status'] = "Successfully updated!";
        header("location: admincontent.php");
        exit();
    }

    $query = mysqli_query($conn, "SELECT * FROM tbl_content WHERE content_id='$content_id'");
    $row = mysqli_fetch_array($query);

    $page_id = $row['page_id'];
    $title = $row['title'];
    $description = $row['description'];
    $display_order = $row['display_order'];
    $image = $row['image'];
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

        <a href="admindashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="admincontent.php"><i class="fa-solid fa-file-lines"></i> Content</a>
        <a href="adminemotions.php"><i class="fa-solid fa-face-smile"></i> Emotions</a>
        <a href="admincharacters.php"><i class="fa-solid fa-user"></i> Characters</a>
        <a href="adminwatch.php"><i class="fa-solid fa-video"></i> Watch</a>
        <a href="adminmessages.php"><i class="fa-solid fa-envelope"></i> Messages</a>

    </div>

    <div class="sidebar-bottom">
        <a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

</div>

<div class="main">

    <h2 class="page-title">Edit Content</h2>

    <div class="card form-card p-4">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Page ID</label>
                <input type="number"
                       name="page_id"
                       class="form-control"
                       value="<?php echo $page_id; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Title (Optional)</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="<?php echo $title; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="5"
                          required><?php echo $description; ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="uploads/<?php echo $image; ?>" width="120">
            </div>

            <div class="mb-3">
                <label class="form-label">Change Image</label>
                <input type="file"
                       name="image"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="<?php echo $display_order; ?>"
                       required>
            </div>

            <div class="form-buttons">

                <div class="left-buttons">
                    <input type="submit" class="btn btn-success" value="UPDATE">
                    <input type="reset" class="btn btn-secondary" value="CLEAR">
                </div>

                <a href="admincontent.php" class="btn btn-dark">BACK</a>

            </div>

        </form>

    </div>

</div>

</body>
</html>