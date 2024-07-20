<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>About iDiscuss</title>
    <style>
    .about-image {
        width: 400px;
        height: 400px;
        object-fit: cover;
        border: 5px solid #701503;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        transition: border-color 0.3s ease;
    }

    .about-image:hover {
        border-color: #B0FA05;
    }


    .card-img-top {
        width: 80%;
        height: 300px;
        object-fit: cover;
    }



    .timeline {
        position: relative;
        margin: 20px 0;
        padding: 0;
        list-style: none;
    }

    .timeline:before {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 2px;
        margin-left: -1.5px;
        content: '';
        background-color: #e9ecef;
    }

    .timeline-item {
        position: relative;
        width: 50%;
        padding: 20px 30px;
        box-sizing: border-box;
    }

    .timeline-item:nth-child(odd) {
        left: 0;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
    }

    .timeline-item::after {
        content: "";
        display: table;
        clear: both;
    }

    .timeline-panel {
        position: relative;
        padding: 0 20px 20px 20px;
        text-align: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        background: #fff;
    }

    .timeline-heading h4 {
        margin-top: 0;
        color: inherit;
    }

    .timeline-body p,
    .timeline-body ul {
        margin-bottom: 0;
    }
    </style>
</head>

<body>
    <?php include 'partials/dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <div class="container my-4">
        <h1 class="text-center mb-4">About iDiscuss</h1>

        <div class="text-center mb-4">
            <img src="partials/Discuss.png" class="img-fluid rounded-circle about-image" alt="About iDiscuss">
        </div>

        <div class="my-4">
            <h2>Our Journey</h2>
            <p>iDiscuss was founded with the vision to create a vibrant and engaging platform where people can come
                together to share knowledge, ask questions, and discuss various topics. From its inception in 2024,
                iDiscuss has grown into a thriving community of users.</p>
        </div>

        <ul class="timeline">
            <li class="timeline-item">
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Foundation</h4>
                    </div>
                    <div class="timeline-body">
                        <p>iDiscuss was founded in 2024 with a mission to connect people through discussions.</p>
                    </div>
                </div>
            </li>
            <li class="timeline-item">
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Developer's story</h4>
                    </div>
                    <div class="timeline-body">
                        <p>Hello! My name is Tejaswini, and I am the sole developer behind iDiscuss. I started this
                            project to create a space where people can discuss various topics, share knowledge, and
                            connect with others. Throughout the development process, I have learned a lot and faced many
                            challenges, but seeing iDiscuss come to life has been incredibly rewarding.</p>
                    </div>
                </div>
            </li>
            <!-- Add more timeline items as needed -->
        </ul>

        <div class="my-4">
            <h2>What We Offer</h2>
            <p>We offer a wide range of categories covering diverse subjects, from technology and science to arts and
                lifestyle. Our user-friendly interface and active moderation ensure that discussions are meaningful and
                respectful.</p>
            <div class="text-center">
                <a href="index.php#categories" class="btn btn-primary">Explore</a>
            </div>
        </div>

        <div class="my-4">
            <h2>Looking Ahead</h2>
            <p>We are constantly working on new features and improvements to make iDiscuss even better. Stay tuned for
                exciting updates and join us on this journey!</p>
        </div>

        <div class="my-4 text-center">
            <h2>Join Us</h2>
            <p>Become a part of our community today. <button class="btn btn-primary" data-toggle="modal"
                    data-target="#signupModal">Sign Up</button></p>
        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7H UibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>