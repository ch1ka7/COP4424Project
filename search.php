<?php require "common.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $parameter["siteName"] ?></title> <!-- echo $parameter["siteName"] -->

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

        <!-- Blog Entries Column -->
        <div class="col-md-8 pt-4">
            <!-- Blog Post -->
            <?php
            if (isset($_GET["tag"])) {
                $blogPosts = $db->prepare("SELECT posts.id as post_id, posts.*, users.* FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.tag = :tag ORDER BY posts.id DESC");
                $blogPosts->execute(array(
                    "tag" => $_GET["tag"]
                ));
            } else if (isset($_GET["keyword"])) {
                $blogPosts = $db->prepare("SELECT posts.id as post_id, posts.*, users.* FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.title LIKE :keyword OR posts.content LIKE :keyword ORDER BY posts.id DESC");
                $blogPosts->execute(array(
                    "keyword" => '%' . $_GET["keyword"] . '%'
                ));
            } else if (isset($_GET["author"])) {
                $blogPosts = $db->prepare("SELECT posts.id as post_id, posts.*, users.* FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.author_id = :author_id ORDER BY posts.id DESC");
                $blogPosts->execute(array(
                    "author_id" => $_GET["author"]
                ));
            } else {
                $blogPosts = $db->prepare("SELECT posts.id as post_id, posts.*, users.* FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY posts.id DESC");
                $blogPosts->execute();
            }
            $blogPosts = $blogPosts->fetchAll(PDO::FETCH_ASSOC); //
            if (count($blogPosts) > 0) {
                foreach ($blogPosts as $post):
                    ?>
                    <div class="card mb-4">
                        <h3 class="card-header"><?= $post["title"] ?></h3>
                        <div class="card-body">
                            <p class="card-text">
                                <?= substr($post["content"], 0, 300) ?>
                                <?= (strlen($post["content"]) > 300) ? "..." : "" ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="text-muted">Posted on <?= $post["date"] ?> by <a
                                        href="./search.php?author=<?= $post["author_id"] ?>"><?= $post["username"] ?></a></span>
                            <a href="post.php?id=<?= $post["post_id"] ?>" class="btn btn-primary btn-sm float-right">Read
                                More &rarr;</a>
                            <?php
                            if (isset($_SESSION["loggedInRole"]) && $_SESSION["loggedInRole"] == 1) {
                                echo '<a onclick="return confirm(\'Post will be deleted. Do you confirm?\');" href="processes.php?action=postdelete&id=' . $post["post_id"] . '" class="btn btn-danger btn-sm float-right mr-2">Delete</a>';
                            }
                            ?>
                        </div>
                    </div>
                <?php
                endforeach;
            } else {
                echo '<div class="alert alert-warning"><strong>No posts found in this search!</strong></div>';
            } ?>
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
