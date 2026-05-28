<!DOCTYPE html>
<html>
<head>

    <title>Register</title>

    <?php include("css.php"); ?>

    <style>

        body{
            margin: 0;
            padding: 0;
            min-height: 100vh;

            background:
            linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
            url("InsideOutImages/BackgroundLogin.jpg");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            font-family: Arial, sans-serif;
        }

        .login-card{
            min-width: 400px;
            border-radius: 15px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(5px);
        }

        .login-title{
            font-weight: bold;
            color: #1f2937;
        }

    </style>

</head>

<body>

<?php
session_start();
require_once "conn.php";

$error = '';

if (isset($_POST["register"])) {

    $admin_fname = trim($_POST['admin_fname']);
    $admin_mname = trim($_POST['admin_mname']);
    $admin_lname = trim($_POST['admin_lname']);
    $admin_username = trim($_POST['admin_username']);

    $admin_password = trim($_POST['admin_password']);
    $confirm_password = trim($_POST['confirm_password']);

    $admin_fname = mysqli_real_escape_string($conn, $admin_fname);
    $admin_mname = mysqli_real_escape_string($conn, $admin_mname);
    $admin_lname = mysqli_real_escape_string($conn, $admin_lname);
    $admin_username = mysqli_real_escape_string($conn, $admin_username);

    if (
        empty($admin_fname) ||
        empty($admin_lname) ||
        empty($admin_username) ||
        empty($admin_password) ||
        empty($confirm_password)
    ) {

        $error = "Please fill in all required fields.";

    } elseif ($admin_password !== $confirm_password) {

        $error = "Passwords do not match.";

    } else {

        $check = mysqli_query(
            $conn,
            "SELECT admin_username 
             FROM $tablelogin 
             WHERE admin_username='$admin_username'"
        );

        if ($check && mysqli_num_rows($check) > 0) {

            $error = "Username already exists.";

        } else {

            // BCRYPT HASHING
            $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO $tablelogin (
                        admin_username,
                        admin_password,
                        admin_fname,
                        admin_mname,
                        admin_lname,
                        created_at
                    )
                    VALUES (
                        '$admin_username',
                        '$hashed_password',
                        '$admin_fname',
                        '$admin_mname',
                        '$admin_lname',
                        NOW()
                    )";

            if (mysqli_query($conn, $sql)) {

                header("Location: login.php");
                exit();

            } else {

                $error = mysqli_error($conn);
            }
        }
    }
}
?>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow login-card">

        <h2 class="text-center mb-4 login-title">
            Register
        </h2>

        <?php if (!empty($error)) { ?>

            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <div class="mb-3">

                <input type="text"
                       name="admin_fname"
                       class="form-control"
                       placeholder="First Name"
                       required>

            </div>

            <div class="mb-3">

                <input type="text"
                       name="admin_mname"
                       class="form-control"
                       placeholder="Middle Name">

            </div>

            <div class="mb-3">

                <input type="text"
                       name="admin_lname"
                       class="form-control"
                       placeholder="Last Name"
                       required>

            </div>

            <div class="mb-3">

                <input type="text"
                       name="admin_username"
                       class="form-control"
                       placeholder="Username"
                       required>

            </div>

            <div class="mb-3">

                <input type="password"
                       name="admin_password"
                       class="form-control"
                       placeholder="Password"
                       required>

            </div>

            <div class="mb-3">

                <input type="password"
                       name="confirm_password"
                       class="form-control"
                       placeholder="Confirm Password"
                       required>

            </div>

            <button type="submit"
                    name="register"
                    class="btn btn-success w-100">

                REGISTER

            </button>

            <div class="text-center mt-3">

                Already have an account?
                <a href="login.php">Login</a>

            </div>

        </form>

    </div>

</div>

<?php include("js.php"); ?>

</body>
</html>