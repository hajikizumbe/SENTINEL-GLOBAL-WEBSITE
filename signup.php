<?php
if (isset($_POST['submit'])) {
    include("connection.php");
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if ($count_user == 0 && $count_email == 0) {
        if ($password == $cpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$hashed_password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<script>
                alert("Registration Successful!");
                window.location.href="index.php";
                </script>';
            } else {
                echo '<script>
                alert("Error in registration!");
                window.location.href="signup.php";
                </script>';
            }
        } else {
            echo '<script>
            alert("Password does not match!");
            window.location.href="signup.php";
            </script>';
        }
    } else {
        echo '<script>
        alert("User Already Exists!");
        window.location.href="index.php";
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
 include "navbar.php";
 ?>
<div id="form">
    <h1 id="heading">Signup form </h1><br>
    <form name="form"  action="signup.php" method="POST">
        <i class="fa-solid fa-user"></i>
        <input type="text" id="user" name="user" placeholder="Enter Username" required><br><br>
        <i class="fa-solid fa-square-envelope"></i>
        <input type="email" id="email" name="email" placeholder="Enter Email" required><br><br>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="pass" name="pass" placeholder="Create Password" required><br><br>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="cpass" name="cpass" placeholder="Retype Password" required><br><br>
        <input type="submit" id="btn" value="SignUp" name="submit"/>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>