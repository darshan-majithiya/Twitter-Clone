<?php

    include('functions.php');
    include('views/header.php');

    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'yourTimeline') {
            include('views/timeline.php');
        } else if ($_GET['page'] == 'yourTweets') {
            include('views/yourTweets.php');
        } else if ($_GET['page'] == 'search') {
            include('views/search.php');
        }  else if ($_GET['page'] == 'PublicProfile') {
            include('views/publicProfile.php');
        } else {
            echo '<div class="container homeContainer">
                <h1 class="display-1"><b>404 Error</b></h1>
                <h1 class="display-4 text-muted">Page not found! </h1>
            </div>';
        }
    } else {
        include('views/home.php');
    }

    include('views/footer.php');
?>
