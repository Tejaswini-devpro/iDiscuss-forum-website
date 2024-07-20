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
    <?php include 'partials/dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    if (isset($_GET['catid']) && is_numeric($_GET['catid'])) {
        $id = intval($_GET['catid']);
        $sql = "SELECT * FROM categories WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc = $row['category_description'];
            }
        } else {
            echo '<div class="container my-4"><div class="alert alert-danger" role="alert">Category not found!</div></div>';
            exit;
        }
    } else {
        echo '<div class="container my-4"><div class="alert alert-danger" role="alert">Invalid category ID!</div></div>';
        exit;
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // Insert thread into DB
        $th_title = $_POST['thread_title'];
        $th_desc = $_POST['thread_desc'];

        // Safety for XSS
        $th_title = htmlspecialchars($th_title);
        $th_desc = htmlspecialchars($th_desc);

        $sno = $_POST['sno'];
        $sql = "INSERT INTO threads (Thread_title, Thread_desc, Thread_cat_id, Thread_user_id, Timestamp) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added. Please wait for the community to respond.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo htmlspecialchars($catname); ?> Forums!</h1>
            <p class="lead"><?php echo htmlspecialchars($catdesc); ?></p>
            <hr class="my-4">
            <p>This peer-to-peer forum is for sharing knowledge with each other. No spam or self-promotion allowed. Do
                not post copyright-infringing materials or offensive content.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem title</label>
                    <input type="text" class="form-control" id="thread_title" name="thread_title"
                        aria-describedby="emailHelp" placeholder="Enter title">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Elaborate your Concern</label>
                    <textarea class="form-control" id="thread_desc" name="thread_desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    } else {
        echo '
        <div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <p class="lead">You are not logged in. Please login to be able to start a discussion.</p>
        </div>';
    }
    ?>

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        // Pagination logic
        $results_per_page = 10; // Number of threads per page
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
        $start_from = ($page - 1) * $results_per_page;

        $total_sql = "SELECT COUNT(*) AS total FROM threads WHERE thread_cat_id=$id";
        $total_result = mysqli_query($conn, $total_sql);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_threads = $total_row['total'];
        $total_pages = ceil($total_threads / $results_per_page);

        $sql = "SELECT * FROM threads WHERE thread_cat_id=$id LIMIT $start_from, $results_per_page";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thread_id = $row['Id'];
            $thread_title = htmlspecialchars($row['Thread_title']);
            $thread_desc = htmlspecialchars($row['Thread_desc']);
            $thread_time = $row['Timestamp'];
            $thread_user_id = $row['Thread_user_id'];

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
                    <div class="media-body">'.
                        '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $thread_id . '"> ' . $thread_title . ' </a></h5>
                        ' . $thread_desc . ' </div>'.
                        '<p class="font-weight-bold my-0">Asked by: ' . $user_email . ' at ' . $thread_time . '</p>'.
                '</div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Threads found.</p>
                        <p class="lead">Be the first person to ask a question</p>
                    </div>
                </div>';
        }
        ?>

        <!-- Pagination links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item '.($page == $i ? 'active' : '').'"><a class="page-link" href="threadlists.php?catid='.$id.'&page='.$i.'">'.$i.'</a></li>';
                }
                ?>
            </ul>
        </nav>
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
