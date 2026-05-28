<!DOCTYPE html>
<html>
<head>
    <title>Inside Out Admin Dashboard</title>

    <?php
        include("css.php");
        include("js.php");
    ?>

    <link rel="stylesheet" href="cssbackend.css">
</head>

<body>

<?php
    include("session.php");
    include("conn.php");

    $emotion_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_emotions"));
    $message_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_messages"));
    $admin_username = $_SESSION['admin_username'];
?>

<div>

    <div class="topbar">
        <a href="dashboard.php">
            <img src="InsideOutImages/InsideOutWordLogo.png" alt="Inside Out" height="40">
        </a>

        <a href="adminprofile.php"
            class="admin-profile-link" style="text-decoration:none !important; color:#1f2937 !important; font-weight:500;">
            <i class="fa-solid fa-user"></i>
            <?php echo $admin_username; ?>
        </a>
    </div>

    <div class="sidebar">

        <div class="sidebar-top">

            <div class="sidebar-title">
                Content and Modules
            </div>

            <a href="admindashboard.php" style="background:#1f2937; color:white;">
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

        <?php if (isset($_SESSION['status'])) { ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php unset($_SESSION['status']); } ?>

        <h2 class="page-title">
            Welcome, <?php echo $admin_username; ?>! 👋
        </h2>

        <div class="stats-container mb-4 gap-5">

        <a href="adminemotions.php" class="stat-link">

            <div class="card card-box p-4 bg-success text-white stat-card">
                <h5>Emotions</h5>
                <h2><?php echo $emotion_count; ?></h2>
            </div>

        </a>

        <a href="adminmessages.php" class="stat-link">

            <div class="card card-box p-4 bg-warning text-white stat-card">
                <h5>Messages</h5>
                <h2><?php echo $message_count; ?></h2>
            </div>
        </a>

</div>

        <div class="card card-box p-3">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    <i class="fa-solid fa-file-lines"></i> Content Pages
                </h5>

                <div>
                    <a href="contentpages_add.php" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus"></i> Add
                    </a>
                </div>

            </div>

            <table class="table table-hover">

                <thead class="table-dark text-center">
                    <tr>
                        <th>Page ID</th>
                        <th>Page Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM tbl_pages");

                        while ($row = mysqli_fetch_array($query)) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $row['page_id']; ?>
                        </td>

                        <td>
                            <?php echo $row['page_name']; ?>
                        </td>

                        <td>
                            <a href="admincontent.php?page_id=<?php echo $row['page_id']; ?>"
                               class="btn btn-primary btn-sm">
                                Manage
                            </a>

                            <a href="deletecontentpage.php?sid=<?php echo $row['page_id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this record?');">
                                Delete
                            </a>
                        </td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>