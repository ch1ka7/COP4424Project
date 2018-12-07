<?php require "common.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign In | <?= $parameter["siteName"] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="processes.php?action=signin" method="post">
    <?php if (!empty($_GET["errorMessage"])): ?>
        <div class="alert alert-danger"><strong><?= base64_decode($_GET["errorMessage"]) ?></strong></div>
    <?php endif; ?>
    <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>

    <!--Input Email-->
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required
           autofocus>
    <!--Input Password-->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <!--
    <div class="checkbox mb-3"></div>
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    Further development can be added later on!
    -->
    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign In</button>
    <p class="mt-5 mb-3 text-muted">
        <a href="./signup.php" class="btn btn-link">Go To Sign Up &raquo;</a>  <!--Go To Sign Up-->
        <a href="./" class="btn btn-link">&laquo; Return to Home Page</a> <!--Go To Home Page-->
    </p>
</form>
</body>
</html>