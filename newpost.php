<?php
require "common.inc.php";
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["loggedInRole"] != 1) {
    header("Location: ./");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Post</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./"><?= $parameter["siteName"] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <!--Home Button-->
                    <a class="nav-link" href="./">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <!--About Button-->
                    <a class="nav-link" href="mystory.php">My Story</a>
                </li>
                <li class="nav-item">
                    <!--Contacts Button-->
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <!-- Vertical Line -->
                <li class="nav-item pl-2 pr-2">
                    <span style="font-size: 24px; color: #666;">|</span>
                </li>
                <!-- Checks if isLoggedIn is set and isLogged in is true-->
                <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]): ?> 
                    <li class="nav-item">
                        <a class="nav-link"
                           href="search.php?author=<?= $_SESSION["loggedInId"] ?>"><?= $_SESSION["loggedInName"] ?></a>
                    </li>
                    <li class="nav-item">
                         <!--Sign Out Button-->
                        <a class="nav-link" href="processes.php?action=signout"
                           onclick="return confirm('Do you confirm?');">Sign Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                         <!--Sign In Button-->
                        <a class="nav-link" href="signin.php">Sign In</a>
                    </li>
                    <li class="nav-item">
                         <!--Sign Up Button-->
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<!-- Page Content -->

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8 mt-4">
            <form action="processes.php?action=newpost" method="post" class="newpostform">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>

                </div>
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" class="form-control" id="tag" name="tag" placeholder="Tag" required>
                </div>
                <div class="form-group">
                    <label for="text">New Post</label>
                    <textarea class="form-control" rows="10" id="post" name="post" required></textarea>
                </div>

                <button class="btn btn-primary btn-lg" type="submit">Post</button>
            </form>
        </div>


        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="search.php" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Search for..." required>
                            <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Tags</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled mb-0">
                                <?php
                                //Performs a query on the database
                                $tagList = $db->query("SELECT tag, Count(1) as tag_count FROM posts GROUP BY tag"); // Groups tags by tagname
                                $tagList = $tagList->fetchAll(PDO::FETCH_ASSOC); //Returns an array containing all of the result set rows
                                if (count($tagList) > 0) { //Checks if there is at least 1 tag
                                    foreach ($tagList as $tagItem)
                                        echo '<li><a href="./search.php?tag=' . $tagItem["tag"] . '">' . $tagItem["tag"] . ' (' . $tagItem["tag_count"] . ')</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="fixed-bottom bg-dark">
    <div class="container mb-5">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    let formHasChanged = false;
    let submitted = false;

    $(document).on('change', 'form.newpostform input, form.newpostform textarea', function (e) {
        formHasChanged = true;
    });

    $(document).ready(function () {
        window.onbeforeunload = function (e) {
            if (formHasChanged && !submitted) {
                var message = "You have not saved your changes.", e = e || window.event;
                if (e) {
                    e.returnValue = message;
                }
                return message;
            }
        };
        $("form").submit(function () {
            submitted = true;
        });
    });
</script>
</body>

</html>
