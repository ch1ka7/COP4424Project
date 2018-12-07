<?php require "common.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="processes.php?action=signup" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Please Sign Up</h1>

    <!--Input Username-->
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required
           autofocus>
    <!--Input Email-->
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required>
    <hr>
    <!--Input Password-->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <!--Input Confirm Password-->
    <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
    <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control"
           placeholder="Confirm Password"
           required>

    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign Up</button>
    <p class="mt-5 mb-3 text-muted">
        <a href="./signin.php" class="btn btn-link">Go To Sign In &raquo;</a> <!--Go To Sign In-->
        <a href="./" class="btn btn-link">&laquo; Return to Home Page</a> <!--Go To Home Page-->
    </p>
</form>
</body>
</html>