<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome to iDiscuss - About Forums</title>

    <!-- card img -->
    <style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card {
        width: 18rem;
        height: 25rem;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    #ques {
        min-height: 433px;
        margin-top: 0; /* Add this line */
    }

    .alert {
        margin-bottom: 0; /* Add this line */
    }

    /* Custom styles for carousel controls */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: black;
        border-radius: 50%;
    }

    .carousel-control-prev-icon {
        background-image: none;
    }

    .carousel-control-next-icon {
        background-image: none;
    }
    </style>
</head>

<body>
    <?php include 'partials/dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    // Display success message if set in session
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['success_message'] . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        unset($_SESSION['success_message']);
    }

    // Display error message if signup failed
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
        $error = htmlspecialchars($_GET['error']);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    ?>

    <!-- Slider -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="partials/Img1.avif" alt="First slide" style="height: 400px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="partials/Img2.avif" alt="Second slide" style="height: 400px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="partials/Img3.avif" alt="Third slide" style="height: 400px;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Category container start -->
    <div class="container my-4" id="ques">
        <h2 class="text-center my-4">Welcome to iDiscuss - Browse Categories</h2>
        <div class="row my-4">
            <!-- Fetch categories -->
            <?php
            $sql = "SELECT * FROM `categories`"; 
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row['category_id']);
                $cat = htmlspecialchars($row['category_name']);
                $cat_image = htmlspecialchars($row['image']);
                $cat_description = htmlspecialchars(substr($row['category_description'], 0, 80));

                echo '<div class="col-md-4 my-2">
                    <div class="card">
                        <img class="card-img-top" src="' . $cat_image . '" '.$cat.' alt="....">
                        <div class="card-body">
                            <h5 class="card-title"><a href="Threadlists.php?catid=' . $id . '"> ' . $cat . ' </a></h5>
                            <p class="card-text">' . $cat_description . '...</p>
                            <a href="Threadlists.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
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
