<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $kind = $_POST['flexRadioDefault'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($pass == $row['pass']) {
            $id = $row['email'];
            if ($email === 'superadmin@gmail.com') {
                header('Location: games.php');
                exit;
            } elseif ($kind !== 'Admin') {
                echo '<form id="redirectForm" method="POST" action="home.php">';
                echo '<input type="hidden" name="id" value="'.$id.'">';
                echo '</form>';
                echo '<script>';
                echo 'document.getElementById("redirectForm").submit();';
                echo '</script>';
                exit;
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid user type</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid password</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">User not found</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="d-flex justify-content-center py-5">
        <form class="form" method="POST" action="index.php">
            <p class="form-title">Sign in to your account</p>
            <div class="input-container">
                <input type="email" placeholder="Enter E-mail" name="email">
            </div>
            <div class="input-container">
                <input type="password" placeholder="Enter password" name="pass">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="indvidual" value="members">
                <label class="form-check-label" for="members">Member</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Admin">
                <label class="form-check-label" for="flexRadioDefault2">Admin</label>
            </div>
            <button type="submit" class="submit btn btn-trinary">Sign in</button>
            <p class="signup-link">No account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
    <script src="Testing/index.js"></script>
</body>
</html>