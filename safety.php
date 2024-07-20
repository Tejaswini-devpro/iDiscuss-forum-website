<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #ques {
        min-height: 433px;
    }
    </style>

    <title>Welcome to iDiscuss - About Forums</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/dbconnect.php'; ?>

    <?php
    // Check if 'catid' is set in the URL and if it is a valid number
    if (isset($_GET['catid']) && is_numeric($_GET['catid'])) {
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE `category_id`=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $catname = htmlspecialchars($row['category_name']);
                $catdesc = htmlspecialchars($row['category_description']);
            } else {
                echo "No category found with ID: $id";
                exit;
            }
        } else {
            echo "Error: " . mysqli_error($conn);
            exit;
        }
    } else {
        echo "Invalid category ID.";
        exit;
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forums!</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This peer-to-peer forum is for sharing knowledge with each other. No spam or self-promotion allowed. Do not post copyright-infringing materials or offensive content.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id"; // Assuming you have a threads table
        $result = mysqli_query($conn, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['Id'];
                $thread_title = htmlspecialchars($row['Thread_title']);
                $thread_desc = htmlspecialchars($row['Thread_desc']);
                echo '<div class="media my-3">
                    <img class="mr-3" src="partials/user.jfif" width="55px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0"> <a  class="text-dark" href="thread.php"> '. $thread_title .' </a></h5>
                        ' . $thread_desc . '
                    </div>
                </div>';
            }
        } else {
            echo "No threads found.";
        }
        ?>
    </div>

    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
