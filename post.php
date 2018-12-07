<?php require "common.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $parameter["siteName"] ?></title>

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
                <li class="nav-item pl-2 pr-2">
                    <span style="font-size: 24px; color: #666;">|</span>
                </li>
                <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]): ?> <!-- Checks if it is set and logged in -->
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

        <!-- Post Content Column -->
        <div class="col-lg-8 mt-4">
            <?php
            $postFound = false;
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) { //id must be set and numeric
                echo '<div class"alert alert-danger"><strong>Post not found!</strong></div>';
            } else {
                //Prepares an SQL statement to be executed by the PDOStatement::execute() method
                $blogPostProcess = $db->prepare("SELECT posts.id as post_id, posts.*, users.* FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.id = :id");
                $blogPostProcess->execute(array(
                    "id" => $_GET["id"]
                ));
                //Fetches a row from a result set associated with a PDOStatement object. The fetch_style parameter determines how PDO returns the row.
                $blogPostResult = $blogPostProcess->fetch(PDO::FETCH_ASSOC);
                if (!$blogPostResult) {
                    echo '<div class="alert alert-danger"><strong>Post not found!</strong></div>';
                } else {
                    $postFound = true;
                    echo '<h1 class="mt-4">' . $blogPostResult["title"] . '</h1>'; //Prints post title
                    echo '<p class="lead">by <a href="./search.php?author=' . $blogPostResult["author_id"] . '">' . $blogPostResult["username"] . '</a></p>'; //Prints post author
                    echo '<hr>';
                    echo '<p>Posted on ' . $blogPostResult["date"] . '</p>'; //Prints post date
                    echo '<hr>';
                    echo '<p>' . $blogPostResult["content"] . '</p>'; //Prints post content
                    echo '<hr>';
                }
            }
            ?>
            <!--Checks if there is a post and isLoggedIn is set and isLogged in is true, then shows new comment text area-->
            <?php if ($postFound && isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]): ?> 
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form action="processes.php?action=newcomment" method="post">
                            <input type="hidden" name="post_id" value="<?= $_GET["id"] ?>">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            if ($postFound) {
                $comments = $db->prepare("SELECT comments.id as comment_id, comments.*, users.* FROM comments INNER JOIN users ON comments.author_id = users.id WHERE post_id = :post_id ORDER BY comment_id DESC");
                $comments->execute(array("post_id" => $_GET["id"]));

                $comments = $comments->fetchAll(PDO::FETCH_ASSOC);
                if (!isset($_SESSION["isLoggedIn"]) && count($comments) > 0) {
                    echo '<h5 class="my-4 card-header">Comments:</h5>';
                }
                if (count($comments) > 0) {//Checks if there is at least one comment, then prints existing comments
                    foreach ($comments as $comment):
                        ?>
                        <div class="media mb-4">
                            <div class="media-body">
                                <h5 class="mt-0"><?= $comment["username"] ?></h5>
                                <?= $comment["comment"] ?>
                                <br><br>
                                <?= $comment["date"] ?>
                                <?php //If user is an author or admin, then there will appear comment delete button
                                if (isset($_SESSION["loggedInId"]) && ($_SESSION["loggedInId"] == $comment["author_id"] || $_SESSION["loggedInRole"] == 1)) {

                                    echo '<a onclick="return confirm(\'Comment will be deleted. Do you confirm?\');" href="processes.php?action=commentdelete&id=' . $comment["comment_id"] . '" class="btn btn-danger btn-sm float-right mr-2">Delete</a>';

                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                    <?php
                    endforeach;
                } else {
                    echo '<div class="alert alert-warning"><strong>No comment!</strong></div>';
                }
            }
            ?>

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
                                $tagList = $db->query("SELECT tag, Count(1) as tag_count FROM posts GROUP BY tag");
                                $tagList = $tagList->fetchAll(PDO::FETCH_ASSOC);
                                if (count($tagList) > 0) {
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

</body>

</html>
