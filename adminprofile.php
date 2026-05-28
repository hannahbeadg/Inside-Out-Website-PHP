<!DOCTYPE html>
<html>
<head>

    <title>Admin Profile</title>

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

$query = mysqli_query($conn, "
    SELECT *
    FROM $tablelogin
    WHERE admin_username='$admin_username'
");

$row = mysqli_fetch_array($query);

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $admin_fname = mysqli_real_escape_string($conn, $_POST['admin_fname']);
    $admin_mname = mysqli_real_escape_string($conn, $_POST['admin_mname']);
    $admin_lname = mysqli_real_escape_string($conn, $_POST['admin_lname']);
    $new_username = mysqli_real_escape_string($conn, $_POST['admin_username']);

    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if(!empty($new_password)) {

        if($new_password != $confirm_password) {

            $_SESSION['status'] = "Passwords do not match!";

            header("location: adminprofile.php");

            exit();
        }

        $hashed_password = hash('sha256', $new_password);

        mysqli_query($conn, "
            UPDATE $tablelogin SET

            admin_fname='$admin_fname',
            admin_mname='$admin_mname',
            admin_lname='$admin_lname',
            admin_username='$new_username',
            admin_password='$hashed_password'

            WHERE admin_username='$admin_username'
        ");

    } else {

        mysqli_query($conn, "
            UPDATE $tablelogin SET

            admin_fname='$admin_fname',
            admin_mname='$admin_mname',
            admin_lname='$admin_lname',
            admin_username='$new_username'

            WHERE admin_username='$admin_username'
        ");
    }

    $_SESSION['admin_username'] = $new_username;

    $_SESSION['status'] = "Profile Successfully Updated!";

    header("location: adminprofile.php");

    exit();
}

?>

<div>

    <div class="topbar">

        <a href="admindashboard.php">

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

            <a href="logout.php"
               class="logout">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

        </div>

    </div>

    <div class="main">

        <?php if(isset($_SESSION['status'])) { ?>

            <div class="alert alert-success alert-dismissible fade show mt-3"
                 role="alert">

                <?php echo $_SESSION['status']; ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>

        <?php unset($_SESSION['status']); } ?>

        <h2 class="page-title">

            Admin Profile

        </h2>

        <div class="card form-card p-4">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        First Name
                    </label>

                    <input type="text"
                           name="admin_fname"
                           class="form-control"
                           value="<?php echo $row['admin_fname']; ?>"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Middle Name
                    </label>

                    <input type="text"
                           name="admin_mname"
                           class="form-control"
                           value="<?php echo $row['admin_mname']; ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Last Name
                    </label>

                    <input type="text"
                           name="admin_lname"
                           class="form-control"
                           value="<?php echo $row['admin_lname']; ?>"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Username
                    </label>

                    <input type="text"
                           name="admin_username"
                           class="form-control"
                           value="<?php echo $row['admin_username']; ?>"
                           required>

                </div>

                <hr>

                <div class="mb-3">

                    <label class="form-label">
                        New Password
                    </label>

                    <input type="password"
                           name="new_password"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input type="password"
                           name="confirm_password"
                           class="form-control">

                </div>

                <div class="form-buttons">

                    <div class="left-buttons">

                        <input type="submit"
                               class="btn btn-success"
                               value="UPDATE PROFILE">

                        <input type="reset"
                               class="btn btn-secondary"
                               value="CLEAR">

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>