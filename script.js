$(document).ready(function () {
    var check = 0;
    $('#login').click(function() {
        if ($('#lstayloggedIn').is(":checked"))
        {
            check = 1;
        }
        $.ajax({
            type: 'POST',
            url: 'actions.php?action=login',
            //data: 'email=' + $('#lemail').val() + '&password=' + $('#lpassword').val(),
            data: {
                email: $('#lemail').val(),
                password: $('#lpassword').val(),
                stayLoggedIn: check,
            },
            success: function(result) {
                if (result == 1) {
                   window.location.assign('/TwitterClone/index.php');
                } else {
                    $('#loginAlert').html(result).show();
                    check = 0;
                }
            },
            error: function() {
                console.log('Unable to connect to sever');
                check = 0;
            }
        })
    });

    $('#signup').click(function() {
        if ($('#sstayloggedIn').is(":checked"))
        {
            check = 1;
        }
        $.ajax({

            type: 'POST',
            url: 'actions.php?action=signup',
            // data: 'email=' + $('#semail').val() + '&password=' + $('#spassword').val() + 'firstname=' + $('#firstname').val() + '&lastname=' + $('#lastname').val(),
            data: {
                email: $('#semail').val(),
                password: $('#spassword').val(),
                firstname: $('#firstname').val(),
                lastname:  $('#lastname').val(),
                stayLoggedIn: check,
            },
            success: function(result) {
                if (result == 1) {
                    window.location.assign('/TwitterClone/index.php');
                } else {
                    $('#signupAlert').html(result).show();
                    check = 0;
                }
            },
            error: function() {
                console.log('Unable to connect to sever');
                check = 0;
            }

        });
    });


    $('.username').mouseover(function() {
        $(this).css('color','#1DA1F2');
    });
    $('.username').mouseleave(function() {
        $(this).css('color','#000');
    });

    $('.userid').mouseover(function() {
        $(this).css('text-decoration','underline');
    });
    $('.userid').mouseleave(function() {
        $(this).css('text-decoration','none');
    });

    $('.toggleFollow').click(function() {
        var id = $(this).attr('data-userId');
        $.ajax({
            type: 'POST',
            url: 'actions.php?action=toggleFollow',
            data: {
                userId: id,
            },
            success: function(result) {
                if (result == 1) {
                     $('button[data-userId="' + id + '"]').html('Follow');
                }
                else if (result == 2) {
                    $('button[data-userId="' + id + '"]').html('Unfollow');
                }
            },


        });

    });

    $('.deleteTweet').click(function() {
        var id = $(this).attr('data-userId');
        $.ajax({
            type: 'POST',
            url: 'actions.php?action=deleteTweet',
            data: {
                tweetId: id,
            },
            success: function(result) {
                if (result == 1) {
                    window.location.reload();
                }
            },
        });
    });

    $('#postTweetBtn').click( function() {
        $.ajax({
            type: 'POST',
            url: 'actions.php?action=postTweet',
            data: {
                tweetContent: $('#postTweetContent').val(),
            },
            success: function(result) {
                if (result == 1) {
                    window.location.reload();
                } else if (result != '') {
                    $('#postFail').html(result).show();
                    $('#postSuccess').hide();
                }
            },
        });
    });
});
