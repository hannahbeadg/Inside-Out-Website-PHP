<!DOCTYPE html>
<html>
<head>
    <title>Add Content Page</title>

    <?php
        include("css.php");
        include("js.php");
    ?>

    <link rel="stylesheet" href="cssbackend.css">
</head>

<body>

<?php
    include("session.php");
    require_once "conn.php";

    $admin_username = $_SESSION['admin_username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $page_name = $_POST['page_name'];

        mysqli_query(
            $conn,
            "INSERT INTO tbl_pages (page_name, created_at)
             VALUES ('$page_name', NOW())"
        );

        $_SESSION['status'] = "Successfully Added!";
        header("Location: admindashboard.php");
    }
?>

<div class="topbar">

    <a href="dashboard.php">
        <img src="InsideOutImages/InsideOutWordLogo.png" alt="Inside Out" height="40">
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
        Add Content Page
    </h2>

    <div class="card form-card p-4">

        <form action="" method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Page Name
                </label>

                <input type="text"
                       class="form-control"
                       name="page_name"
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

                <a href="admindashboard.php"
                   class="btn btn-dark">
                    BACK
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>