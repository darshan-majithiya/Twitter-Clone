<?php
    include('functions.php');
    $error = '';

    if ($_GET['action'] == 'login') {

        if (!$_POST['email']){
            $error = $error.'An email address is required.<br />';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = $error.'Enter a valid email address.<br />';
        }

        if (!$_POST['password']){
            $error = $error.'The password is required.<br />';
        }

        if($error != '') {
            echo $error;
        } else {
            $query = 'SELECT * FROM user WHERE email = "'.mysqli_real_escape_string($conn, $_POST['email']).'" LIMIT 1';
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if (password_verify($_POST['password'], $row['password'])){
                    $_SESSION['id'] = $row['id'];
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie('id', $_SESSION['id'], time() + 60*60*24*30);
                    }
                    $_SESSION['email'] = $row['email'];
                    echo 1;
                } else {
                    echo 'Couldn\'t find the username/password combination. Please try again.';
                }
            } else {
                echo 'The user doesn\'t exist! Please try signing up.';
            }
        }
    }

    else if($_GET['action'] == 'signup') {

        if (!$_POST['email']){
            $error = $error.'An email address is required.<br />';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = $error.'Enter a valid email address.<br />';
        }

        if (!$_POST['password']){
            $error = $error.'The password is required.<br />';
        }

        if (!$_POST['firstname']){
            $error = $error.'Your firstname is required.<br />';
        }

        if (!$_POST['lastname']){
            $error = $error.'Your lastname is required.<br />';
        }

        if ($error != '') {
            echo $error;
        } else {
            $query = 'SELECT * FROM user WHERE email = "'.mysqli_real_escape_string($conn, $_POST['email']).'" LIMIT 1';
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = 'Entered email is already taken.<br />';
            } else {
                $option = [
                    'cost' => 12,
                ];
                $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT, $option);
                $addRecord = "INSERT INTO user (email, password, firstName, lastName) VALUES ('".mysqli_real_escape_string($conn, $_POST['email'])."', '".$password."','".mysqli_real_escape_string($conn, $_POST['firstname'])."','".mysqli_real_escape_string($conn, $_POST['lastname'])."')";

                if (!mysqli_query($conn, $addRecord)) {
                    $error = "Couldn't Sign in! Please try again.".mysqli_error($conn);
                } else{
                    echo 1;
                    $_SESSION['id'] = mysqli_insert_id($conn);
                    if ($_POST['stayLoggedIn'] == 0) {
                        setcookie('id', mysqli_insert_id($conn), time() + 60*60*24*30);
                    }
                    $_SESSION['email'] = $_POST['email'];
                }
            }

            if ($error !='') {
                echo $error;
            }
        }
    }
/*--------Toggle Follow-Unfollow-------*/
    if ($_GET['action'] == 'toggleFollow') {
        $query = 'SELECT * FROM follow WHERE follower = "'.mysqli_real_escape_string($conn, $_SESSION['id']).'" and following ="'.mysqli_real_escape_string($conn, $_POST['userId']).'" LIMIT 1';
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $deleteQuery = 'DELETE FROM follow WHERE id = "'.mysqli_real_escape_string($conn,$row['id']).'" LIMIT 1';
            mysqli_query($conn, $deleteQuery);
            echo 1;
        } else {
            $insertQuery = 'INSERT INTO follow (follower, following) VALUES("'.mysqli_real_escape_string($conn, $_SESSION['id']).'","'.mysqli_real_escape_string($conn,
            $_POST['userId']).'")';
            mysqli_query($conn, $insertQuery);
            echo 2;

        }
    }

/*--------Post Tweet-------*/
    if ($_GET['action'] == 'postTweet') {
        if (!$_POST['tweetContent']) {
            echo 'Your tweet is empty!';
        } else if (strlen($_POST['tweetContent']) > 140) {
            echo 'Your tweet is too long';
        } else {
            $tweetPostQuery = 'INSERT INTO tweets (tweets, userid, dateTime) VALUES("'.mysqli_real_escape_string($conn, $_POST['tweetContent'] ).'","'.mysqli_real_escape_string($conn, $_SESSION['id']).'", NOW())';
            if (mysqli_query($conn, $tweetPostQuery)) {
                echo 1;
            }

        }
    }
/*--------Delete Tweet-------*/
    if ($_GET['action'] == 'deleteTweet') {
        $deleteTweetQuery ='DELETE FROM tweets WHERE id = "'.mysqli_real_escape_string($conn,$_POST['tweetId']).'" LIMIT 1';
        if (mysqli_query($conn, $deleteTweetQuery)) {
            echo 1;
        }
    }
?>
