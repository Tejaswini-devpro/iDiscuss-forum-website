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
    <?php
    
    include 'partials/dbconnect.php';
    include 'partials/_header.php';
    ?>

    <?php
    if (isset($_GET['threadid']) && is_numeric($_GET['threadid'])) {
        $id = intval($_GET['threadid']);
        $sql = "SELECT * FROM threads WHERE Id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = htmlspecialchars($row['Thread_title']);
                $desc = htmlspecialchars($row['Thread_desc']);
                $thread_user_id = htmlspecialchars($row['Thread_user_id']);

                //Query the users table to find out the name of the poster.
                $sql2 = "SELECT user_email FROM users WHERE sr_no='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $posted_by = $row2['user_email'];
    

            }
        } else {
            echo '<div class="container my-4"><div class="alert alert-danger" role="alert">Thread not found!</div></div>';
            exit;
        }
    } else {
        echo '<div class="container my-4"><div class="alert alert-danger" role="alert">Invalid thread ID!</div></div>';
        exit;
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        //Insert into thread DB
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);

        $sno = $_POST['sno'];

        $sql = "INSERT INTO comments (comment_content, thread_id, comment_by, comment_time) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been added.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This peer-to-peer forum is for sharing knowledge with each other. No spam or self-promotion allowed. Do not post copyright-infringing materials or offensive content.</p>
            <p>Posted by: <em><?php echo $posted_by;?></em></p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
            <h1 class="py-2">Post a comment</h1>
            <form action="' .$_SERVER['REQUEST_URI']. '" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                </div>
                <button type="submit" class="btn btn-success">Post comment</button>
            </form>
        </div>';
    } else {
        echo '<div class="container">
            <h1 class="py-2">Post a comment</h1>
            <p class="lead">You are not logged in. Please login to be able to post a comment.</p>
        </div>';
    }
    ?>

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM comments WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $comment_id = $row['comment_id'];
            $content = htmlspecialchars($row['comment_content']);
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];

            $sql2 = "SELECT user_email FROM users WHERE sr_no='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 && mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $user_email = htmlspecialchars($row2['user_email']);
            } else {
                $user_email = 'Unknown user';
            }

            echo '<div class="media my-3">
                    <img class="mr-3" src="partials/user.jfif" width="55px" alt="Generic placeholder image">
                    <div class="media-body">
                    <p class="font-weight-bold my-0">'.$user_email.' at '. $comment_time .'</p>
                        ' . $content . '
                    </div>
                </div>';
        }

        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4">No Comments found.</p>
                <p class="lead">Be the first person to comment.</p>
            </div>
        </div>';
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
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7H5uibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
</html>
