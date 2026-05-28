<!DOCTYPE html>
<html>
<head>

    <title>Inside Out Admin Characters</title>

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

    <div class="topbar">

        <a href="dashboard.php">

            <img src="InsideOutImages/InsideOutWordLogo.png"
                 alt="Inside Out"
                 height="40">

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

            <a href="admincharacters.php" style="background:#1f2937; color:white;">
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

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

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

        <div class="card card-box p-3">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">

                    <i class="fa-solid fa-user"></i>

                    Characters

                </h5>

                <div class="d-flex align-items-center gap-2">

                    <form action=""
                          method="GET"
                          class="d-flex">

                        <input type="text"
                               name="search"
                               class="form-control form-control-sm me-2"
                               placeholder="Search character..."
                               value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

                        <button type="submit"
                                class="btn btn-dark btn-sm">

                            <i class="fa-solid fa-magnifying-glass"></i>

                        </button>

                    </form>

                    <a href="admincharacters.php"
                       class="btn btn-secondary btn-sm">

                        Reset

                    </a>

                    <a href="characters_add.php"
                       class="btn btn-primary btn-sm">

                        <i class="fa-solid fa-plus"></i>

                        Add

                    </a>

                </div>

            </div>

            <table class="table table-hover table-bordered align-middle">

                <thead class="table-dark text-center">

                    <tr>

                        <th>Character ID</th>
                        <th>Emotion ID</th>
                        <th>Character Name</th>
                        <th>Character Role</th>
                        <th>Character Image</th>
                        <th>Description</th>
                        <th>Updated At</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody class="text-center">

                    <?php

                        if (isset($_GET['search'])) {

                            $search = mysqli_real_escape_string($conn, $_GET['search']);

                            $query = mysqli_query(
                                $conn,
                                "SELECT * FROM tbl_characters
                                 WHERE character_name LIKE '%$search%'
                                    OR character_role LIKE '%$search%'
                                    OR character_description LIKE '%$search%'
                                 ORDER BY character_id ASC"
                            );

                        } else {

                            $query = mysqli_query(
                                $conn,
                                "SELECT * FROM tbl_characters
                                 ORDER BY character_id ASC"
                            );
                        }

                        while ($row = mysqli_fetch_array($query)) {
                    ?>

                    <tr>

                        <td>
                            <?php echo $row['character_id']; ?>
                        </td>

                        <td>
                            <?php echo $row['emotion_id']; ?>
                        </td>

                        <td>
                            <?php echo $row['character_name']; ?>
                        </td>

                        <td>
                            <?php echo $row['character_role']; ?>
                        </td>

                        <td>

                            <img src="uploads/<?php echo $row['character_image']; ?>"
                                 width="80"
                                 class="img-thumbnail">

                        </td>

                        <td>
                            <?php echo $row['character_description']; ?>
                        </td>

                        <td>
                            <?php echo $row['updated_at']; ?>
                        </td>

                        <td>

                            <a href="edit_characters.php?id=<?php echo $row['character_id']; ?>"
                               class="btn btn-primary btn-sm mb-1">

                                Edit

                            </a>

                            <a href="deletecharacters.php?id=<?php echo $row['character_id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this character?');">

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