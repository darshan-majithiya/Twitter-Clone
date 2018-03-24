<?php

    session_start();

    $hostName = "your_hostname";
    $userName = "your_username";
    $password = "your_password";
    $databaseName = "twitter";
    $conn = mysqli_connect($hostName, $userName, $password, $databaseName);

    if(isset($_COOKIE['id'])) {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (mysqli_connect_errno()) {
        die("Connection Error: ".mysqli_connect_error($conn));
        exit();
    }

    if (array_key_exists('function',$_GET) and $_GET['function'] == 'logout') {
        session_unset();
        setcookie('id','',time() - 60*60);
        $_COOKIE['id'] = Null;
    }

    /*------Time since-----*/
    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    /*------Display Tweets-----*/
    function displayTweets($type) {
         global $conn;
         if ($type == 'public') {
             $whereClause  = '';
         } else if ($type == 'isFollowing') {
             $query = 'SELECT * FROM follow WHERE follower = "'.mysqli_real_escape_string($conn, $_SESSION['id']).'"';
             $result = mysqli_query($conn, $query);
             $whereClause  = '';
             if (mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     if ( $whereClause  == '') {
                         $whereClause = 'WHERE ';
                     } else {
                         $whereClause .= ' OR ';
                     }
                      $whereClause .= 'userid = "'.$row['following'].'"';
                 }
             } else {
                 echo '<p><h5>There no tweets from the people you follow! Check out the Recent Tweets below.</h5><p>';
             }
         } else if ($type == 'yourTweets') {
            $whereClause = 'WHERE userid = "'.mysqli_real_escape_string($conn, $_SESSION['id']).'" ';
        } else if ($type == 'searchTweets') {
            echo '<h4>Showing results for "'.mysqli_real_escape_string($conn, $_GET['searchQuery']).'"</h4>';
            $whereClause = 'WHERE tweets LIKE "%'.mysqli_real_escape_string($conn, $_GET['searchQuery']).'%"';
        } else if (is_numeric($type)) {
            $whereClause = 'WHERE userid = "'.$type.'" ';
          }

         $displayQuery = 'SELECT * FROM tweets '.$whereClause.'ORDER BY dateTime DESC';
         $displayResult = mysqli_query($conn, $displayQuery);

         /*------Tweets Body-----*/
         if (mysqli_num_rows($displayResult) == 0) {
             echo '<p><h5>There are no tweets to display!</h5><p>';
         } else {
             date_default_timezone_set('Asia/Calcutta');
             while ($row = mysqli_fetch_assoc($displayResult)) {
                 $userQuery = 'SELECT * FROM user WHERE id = '.mysqli_real_escape_string($conn, $row['userid']).' LIMIT 1';
                 $userResult = mysqli_query($conn, $userQuery);
                 $user = mysqli_fetch_assoc($userResult);
                 echo '<div class="row tweetContainer">';
                 echo '<div class="col-md-12">';
                 echo '<div class="row justify-content-between">';
                 echo '<span><span id="userInfo"><a href="?page=PublicProfile&userid='.$user['id'].'"><span class="username">'.$user['firstName'].' '.$user['lastName'].'</span><span class="text-muted userid">'.$user['email'].'</span></span></a><button type="button" class="btn btn-link toggleFollow" data-userId="'.$row['userid'].'">';

                 if (isset($_SESSION['id']) and $_SESSION['id'] != $row['userid']) {
                     $isFollowingQuery = 'SELECT * FROM follow WHERE follower = "'.mysqli_real_escape_string($conn, $_SESSION['id']).'" and following ="'.mysqli_real_escape_string($conn, $row['userid']).'" LIMIT 1';
                     $isFollowingQueryResult = mysqli_query($conn, $isFollowingQuery);

                     if (mysqli_num_rows($isFollowingQueryResult) > 0) {
                         echo 'Unfollow';
                     } else {
                          echo 'Follow';
                     }

                 } else{
                     echo '';
                 }
                 echo '</button></span>';
                 echo '<span class="text-muted">'.time_since(time() - strtotime($row['dateTime'])).' ago</span></div>';
                 echo '<div class="row tweet justify-content-around">';
                 echo '<div class="col-lg-10">';
                 echo $row['tweets'];
                 echo '</div>';
                 echo '<div class="col-lg-1">';
                 echo '<button type="button" class="btn btn-link deleteTweet" data-userId="'.$row['id'].'">';
                 if (isset($_SESSION['id']) and $_SESSION['id'] == $row['userid']) {
                    echo 'Delete';

                 } else{
                     echo '';
                 }
                 echo '</button>';
                 echo '</div>';
                 echo '</div>';
                 echo '</div>';
                 echo '</div>';
             }
         }
     }

     /*-----Display Search Box------*/
      function displaySearch() {
          echo ' <form class="form-inline my-2 my-lg-0 searchTweet">
                    <input type="hidden" name="page" value="search">
                    <input class="form-control mr-sm-2" name="searchQuery" type="search" id="searchTweet" placeholder="Type the keyword">
                    <button class="btn btn-primary my-2 my-sm-0 searchbutton" type="submit" role="SearchTweets">Search Tweets</button>
                </form>';

      }

      /*-----Post Tweets------*/
      function postTweet() {

          if (isset($_SESSION['id'])) {
              echo '<hr /><div class="form-group">
                        <textarea class="form-control" id="postTweetContent" placeholder="How\'s life?" rows="3"></textarea>
                        <small class="text-muted">(max. length 140 characters)</small>
                    </div>
                    <button class="btn btn-primary my-2 my-sm-0" type="button" id="postTweetBtn" role="PostTweets">Post</button>
                    <div class="alert alert-danger" id="postFail" role="alert"></div>';
        }
      }

       /*-----Display Users------*/
       function displayUsers() {
           global $conn;
           $publicProfileQuery = 'SELECT * FROM user';
           $publicProfileResult = mysqli_query($conn, $publicProfileQuery);
           while ($publicProfile = mysqli_fetch_assoc($publicProfileResult)) {
               if ($publicProfile['id'] != $_SESSION['id']) {
                   echo '<div class="row profileContainer justify-content-between">';
                   echo '<div class="col-md-12">';
                   echo '<span><span id="profileInfo"><a href="?page=PublicProfile&userid='.$publicProfile['id'].'"><span class="username">'.$publicProfile['firstName'].' '.$publicProfile['lastName'].'</span><br /><span class="text-muted userid">'.$publicProfile['email'].'</span></a></span><button type="button" class="btn btn-link toggleFollow" data-userId="'.$publicProfile['id'].'">';

                   $isFollowingQuery = 'SELECT * FROM follow WHERE follower = "'.mysqli_real_escape_string($conn, $_SESSION['id']).'" and following ="'.mysqli_real_escape_string($conn, $publicProfile['id']).'" LIMIT 1';
                       $isFollowingQueryResult = mysqli_query($conn, $isFollowingQuery);

                       if (mysqli_num_rows($isFollowingQueryResult) > 0) {
                           echo 'Unfollow';
                       } else {
                            echo 'Follow';
                       }
                   echo '</button></span>';
                   echo '</div>';
                   echo '</div>';
               }
           }
       }

       /*-----Display Profile Header------*/
      function displayProfileHeader($id) {
          global $conn;
          $ProfileHeaderQuery = 'SELECT * FROM user WHERE id = '.mysqli_real_escape_string($conn, $id).' LIMIT 1';
          $ProfileHeaderResult = mysqli_query($conn, $ProfileHeaderQuery);
          $ProfileHeader = mysqli_fetch_assoc($ProfileHeaderResult);
          echo '<h2>'. $ProfileHeader['firstName'].' '. $ProfileHeader['lastName'].'\'s Tweets<hr /></h2>';

      }

?>
