<?php
$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    session_start(); // Start the session here
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sr_no'];
            $_SESSION['useremail'] = $email;
            header("Location: /Forum/index.php");
            exit(); // Make sure to call exit() after header redirection
        } else {
            echo "Unable to login";
        }
    } else {
        echo "Invalid email or password";
    }
}
?>
