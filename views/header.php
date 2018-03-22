<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="/TwitterClone/styles.css">
    <title>Twitter</title>
</head>
<body>

    <!--SIGN UP FORM MODAL-->
    <div class="modal fade text-align-center" id="signUpModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-style">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="signUpModalTitle">Be the part of world's fastest growing community!</h5>
          </div>
          <div class="modal-body">
              <div class="alert alert-primary text-center" id="signupAlert"></div>
              <form class="justify-content-center">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="firstname">Firstname</label>
                      <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Firstname" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lastname">Lastname</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname" autocomplete="off" required>
                    </div>
                  </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="semail">Email</label>
                    <input type="email" name="semail" class="form-control" id="semail" placeholder="Email" autocomplete="off" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="spassword">Password</label>
                    <input type="password" name = "spassword" class="form-control" id="spassword" placeholder="Password" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sstayloggedIn" checked>
                    <label class="form-check-label" for="sstayloggedIn" >
                     Keep me logged in
                    </label>
                  </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 align-self-center">
                        <button type="button" name="signup" class="btn btn-primary btn-md" id="signup" >Sign up</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <!-- END OF SIGN UP FORM MODAL-->

    <!-- LOGIN FORM MODAL-->
    <div class="modal fade text-align-center" id="LoginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-style">
          <div class="modal-header text-center">
            <h5 class="modal-title align-self-center" id="LoginModalTitle">Welcome back!</h5>
          </div>
          <div class="modal-body">
              <div class="alert alert-primary text-center" id="loginAlert"></div>
              <form class="justify-content-center">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="lemail">Email</label>
                    <input type="email" name="lemail" class="form-control" id="lemail" placeholder="Email" autocomplete="off" required>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="lpassword">Password</label>
                    <input type="password" name="lpassword" class="form-control" id="lpassword" placeholder="Password" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="lstayloggedIn" checked>
                    <label class="form-check-label" for="lstayloggedIn">
                     Keep me logged in
                    </label>
                  </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 align-self-center">
                        <button type="button" name="login" id="login" class="btn btn-primary btn-md">Login</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <!-- END OF LOGIN FORM MODAL -->

    <!-- NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-light">

      <a class="navbar-brand" href="index.php">Twitter<?php if (!isset($_SESSION['id'])) { ?><i class="fab fa-twitter"></i><?php }?></a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION['id'])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=yourTimeline">Your Timeline</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=yourTweets">Your Tweets</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=PublicProfile">Public Profiles</a>
              </li>
               <?php } ?>
          </ul>

          <form class="form-inline my-2 my-lg-0">
            <?php if (isset($_SESSION['id']) and isset($_SESSION['email'])) { ?>
                <i class="fab fa-twitter"></i>
                <a <?php echo 'href="?page=PublicProfile&userid='.$_SESSION['id'].'"'; ?> class="text-muted"><?php echo $_SESSION['email']; ?></a>
                <a href="?function=logout"><button type="button" class="btn btn-primary btn-md btn-margin" role="Logout">Logout</button></a>
            <?php } else { ?>
                <button type="button" class="btn btn-primary btn-md btn-margin" data-toggle="modal" data-target="#LoginModal" role="Login">Login</button>
                <button type="button" class="btn btn-primary btn-md btn-margin" data-toggle="modal" data-target="#signUpModal" role="signUp">Sign up</button>
            <?php } ?>
        </form>
      </div>
    </nav>
    <!-- END OF NAV BAR -->
