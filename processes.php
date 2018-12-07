<?php require "common.inc.php";

switch ($_GET["action"]) {
    case "signin": //Sign in process
        $blogSignInProcess = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password"); //Prepares a statement for execution and returns a statement object
        $blogSignInProcess->execute(array( //Executes a prepared statement
            "email" => $_POST["email"],
            "password" => sha1($_POST["password"])
        ));

        $blogSignInResult = $blogSignInProcess->fetch(PDO::FETCH_ASSOC); //Returns an array containing all of the result set rows
        if (!$blogSignInResult) {
            header("Location: signin.php?errorMessage=" . base64_encode("Sign in failed!"));
            exit();
        } else {
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["loggedInId"] = $blogSignInResult["id"];
            $_SESSION["loggedInName"] = $blogSignInResult["username"];
            $_SESSION["loggedInRole"] = $blogSignInResult["role"];

            header("Location: ./");
            exit();
        }
        break;

    case "signout": //Sign out process
        session_destroy(); //Kills the session
        header("Location: ./"); //Directs to home page
        break;

    case "signup": //Sign up process
        if (empty($_POST["inputUsername"]) || empty($_POST["inputEmail"]) || empty($_POST["inputPassword"]) || empty($_POST["inputConfirmPassword"])) {
            echo '<script>alert("Please fill in all forms!"); window.history.back();</script>'; //If there is an empty form, alerts to fill in
        } else if ($_POST["inputPassword"] != $_POST["inputConfirmPassword"]) { //Password must match
            echo '<script>alert("Passwords are not the same!"); window.history.back();</script>';
        } else {

            $blogSignUpProcess = $db->prepare("INSERT INTO users VALUES (NULL, 2, :username, :password, :email)");
            $blogSignUpProcess->execute(array( //Executes a prepared statement
                "username" => $_POST["inputUsername"],
                "password" => sha1($_POST["inputPassword"]),
                "email" => $_POST["inputEmail"]
            ));
            //If email is already used to sign up for other account, sign up can not be completed
            if ($blogSignUpProcess->errorInfo()[1] > 0) {
                echo '<script>alert("Error! Exception detail: ' . $blogSignUpProcess->errorInfo()[2] . '"); window.history.back();</script>';
            } else { //All conditions are satisfied, new user is created
                $BlogSignInProcess = $db->prepare("SELECT * FROM users WHERE email = :email");
                $BlogSignInProcess->execute(array(
                    "email" => $_POST["inputEmail"]
                ));

                $blotSignInResult = $BlogSignInProcess->fetch(PDO::FETCH_ASSOC); //
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["loggedInId"] = $blotSignInResult["id"];
                $_SESSION["loggedInName"] = $blotSignInResult["username"];
                $_SESSION["loggedInRole"] = $blotSignInResult["role"];

                echo '<script>alert("User created. Welcome!"); location.href = "./";</script>';
            }
        }
        break;

    case "postdelete": //Post delete process
        if (isset($_SESSION["isLoggedIn"]) && $_SESSION["loggedInRole"] == 1) {//Check if logged in and if logged in user is admin
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {//Id must be numeric, if it is not then there is no such post. It prevents from accessing by typing URL
                echo '<script>alert("Post not found!"); location.href = "./";</script>';
            } else {
                $blogPostDeleteProcess = $db->prepare("SELECT id FROM posts WHERE id = :id");
                $blogPostDeleteProcess->execute(array(
                    "id" => $_GET["id"]
                ));

                $blogPostResult = $blogPostDeleteProcess->fetch(PDO::FETCH_ASSOC);
                if (!$blogPostResult) {
                    echo '<script>alert("Post not found!"); location.href = "./";</script>';
                } else {
                    $postCommentDeleteProcess = $db->prepare("DELETE FROM comments WHERE post_id = :post_id");//First deletes comment under the post
                    $postCommentDeleteProcess->execute(array(
                        "post_id" => $blogPostResult["id"]
                    ));
                    $blogPostDeleteProcess = $db->prepare("DELETE FROM posts WHERE id = :id");//After deleting comments, the post is deleted
                    $blogPostDeleteProcess->execute(array(
                        "id" => $_GET["id"]
                    ));
                    echo '<script>alert("Post has been deleted!"); location.href = "./";</script>';
                }
            }
        } else {
            echo '<script>alert("You are not authorized!"); location.href = "./";</script>';
        }
        break;

    case "commentdelete": //Comment delete process
        if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {//Id must be numeric, if it is not then there is no such comment. It prevents from accessing by typing URL
                echo '<script>alert("Comment not found!"); location.href = "./";</script>';
            } else {
                $postCommentDeleteProcess = $db->prepare("SELECT id, author_id FROM comments WHERE id = :id");
                $postCommentDeleteProcess->execute(array(
                    "id" => $_GET["id"]
                ));

                $blogPostResult = $postCommentDeleteProcess->fetch(PDO::FETCH_ASSOC);
                if (!$blogPostResult) {
                    echo '<script>alert("Comment not found!"); location.href = "./";</script>';
                } else {
                    if ((isset($_SESSION["loggedInId"]) && $_SESSION["loggedInId"] == $blogPostResult["author_id"]) || ($_SESSION["loggedInRole"] == 1)) {//Check if logged in user is admin or writer of that comment
                        $postCommentDeleteProcess = $db->prepare("DELETE FROM comments WHERE id = :id");
                        $postCommentDeleteProcess->execute(array(
                            "id" => $_GET["id"]
                        ));
                        echo '<script>alert("Comment has been deleted!"); location.href = "./";</script>';
                    } else {
                        echo '<script>alert("You are not authorized!"); location.href = "./";</script>';
                    }
                }
            }
        } else {
            echo '<script>alert("You are not authorized!"); location.href = "./";</script>';
        }
        break;

    case "newpost": // New post process
        if (isset($_SESSION["isLoggedIn"]) && $_SESSION["loggedInRole"] == 1) {//Check if logged in and if logged in user is admin
            if (empty($_POST["title"]) || empty($_POST["tag"]) || empty($_POST["post"])) {//All forms must be filled in
                echo '<script>alert("Please fill in all forms!"); location.href = "./newpost.php";</script>';
            } else {
                $blogPostProcess = $db->prepare("INSERT INTO posts VALUES (NULL, :author_id, :title, :content, :tag, CURRENT_TIMESTAMP)");
                $blogPostProcess->execute(array(
                    "author_id" => $_SESSION["loggedInId"],
                    "title" => $_POST["title"],
                    "content" => $_POST["post"],
                    "tag" => $_POST["tag"]
                ));
                echo '<script>alert("Post has been added!"); location.href = "./";</script>';
            }
        } else {
            echo '<script>alert("You are not authorized!"); location.href = "./";</script>';
        }
        break;

    case "newcomment": // New comment process
        if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {//Only logged in users can leave comments
            if (!isset($_POST["post_id"]) || !is_numeric($_POST["post_id"])) {
                echo '<script>alert("Post not found!"); window.history.back();</script>';
            } else if (empty($_POST["comment"])) {
                echo '<script>alert("Please fill in all forms!"); window.history.back();</script>';
            } else {
                $blogCommentProcess = $db->prepare("SELECT id FROM posts WHERE id = :id"); //
                $blogCommentProcess->execute(array(
                    "id" => $_POST["post_id"]
                ));

                $blogCommentResult = $blogCommentProcess->fetch(PDO::FETCH_ASSOC);
                if (!$blogCommentResult) {
                    echo '<script>alert("Post not found!"); location.href = "./";</script>';
                } else {
                    $blogCommentProcess = $db->prepare("INSERT INTO comments VALUES (NULL, :post_id, :author_id, :comment, CURRENT_TIMESTAMP)");
                    $blogCommentProcess->execute(array(
                        "post_id" => $_POST["post_id"],
                        "author_id" => $_SESSION["loggedInId"],
                        "comment" => $_POST["comment"]
                    ));
                    echo '<script>alert("Comment has been added!"); location.href = "./post.php?id=' . $_POST["post_id"] . '";</script>';
                }
            }
        } else {
            echo '<script>alert("You are not authorized!"); location.href = "./";</script>';
        }
        break;
}
?>