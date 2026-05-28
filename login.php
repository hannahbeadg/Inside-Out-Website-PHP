<!DOCTYPE html>
<html>
<head>
    <title>Inside Out Admin Login</title>

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
            min-width: 350px;
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

if (isset($_POST["login"])) {

    $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    $admin_password = $_POST['admin_password'];

    // Get user record by username only
    $sql = "SELECT * FROM $tablelogin 
            WHERE admin_username='$admin_username'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_array($result);

        // VERIFY BCRYPT PASSWORD
        if (password_verify($admin_password, $row['admin_password'])) {

            $_SESSION['admin_username'] = $admin_username;

            header("Location: admindashboard.php");
            exit();

        } else {
            $error = "Invalid username and/or password.";
        }

    } else {
        $error = "Invalid username and/or password.";
    }

    mysqli_close($conn);
}
?>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow login-card">

        <h2 class="text-center mb-4 login-title">
            Login Form
        </h2>

        <?php if (!empty($error)) { ?>

            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <div class="mb-3">

                <label>Username</label>

                <input type="text"
                       name="admin_username"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Password</label>

                <input type="password"
                       name="admin_password"
                       class="form-control"
                       required>

            </div>

            <button type="submit"
                    name="login"
                    class="btn btn-success w-100">

                LOGIN

            </button>

            <div class="text-center mt-3">

                Create Account
                <a href="register.php">Here</a>

            </div>

        </form>

    </div>

</div>

<?php include("js.php"); ?>

</body>
</html>