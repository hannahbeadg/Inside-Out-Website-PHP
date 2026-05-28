<!DOCTYPE html>
<html>
<head>
    <title>Inside Out Admin Messages</title>

    <?php
        include("session.php");
        include("conn.php");
        include("css.php");
        include("js.php");
    ?>

    <link rel="stylesheet" href="cssbackend.css">
</head>

<body>

<?php
    $admin_username = $_SESSION['admin_username'];
?>

<div>

    <?php if (isset($_SESSION['status'])) { ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <?php echo $_SESSION['status']; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php unset($_SESSION['status']); } ?>

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

            <a href="adminmessages.php" style="background:#1f2937; color:white;">
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

        <div class="card card-box p-3">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    <i class="fa-solid fa-envelope"></i> Messages
                </h5>

            </div>

            <table class="table table-hover table-bordered align-middle">

                <thead class="table-dark text-center">

                    <tr>
                        <th>Message ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody class="text-center">

                    <?php
                        $query = mysqli_query(
                            $conn,
                            "SELECT * FROM tbl_messages ORDER BY created_at DESC"
                        );

                        while ($row = mysqli_fetch_array($query)) {
                    ?>

                    <tr>

                        <td><?php echo $row['message_id']; ?></td>

                        <td><?php echo $row['message_name']; ?></td>

                        <td><?php echo $row['message_email']; ?></td>

                        <td><?php echo $row['message_text']; ?></td>

                        <td><?php echo $row['created_at']; ?></td>

                        <td>

                            <a href="deletemessage.php?id=<?php echo $row['message_id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Delete this message?');">
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