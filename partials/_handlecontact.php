<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $Email = $_POST['email'];
    $Mobile = $_POST['mobile'];
    $Message = $_POST['message'];

    // SQL query to insert data into database
    $sql = "INSERT INTO contacts (email, mobile, message) VALUES ('$Email', '$Mobile', '$Message')";
    $result = mysqli_query($conn, $sql);

    // Execute query
    if ($result) {
        // Store success message in session
        $_SESSION['success_message'] = "Thank you for getting in touch with us.";
        
        // Redirect to index page
        header("Location: /Forum/index.php");
        exit();
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
