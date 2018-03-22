<div class="container homeContainer">
    <div class="row">
        <div class="col-md-8">
            <h2>Recent Tweets<hr /></h2>
            <?php displayTweets('public'); ?>
        </div>
        <div class="col-md-4">
            <?php displaySearch(); ?>
            <?php postTweet(); ?>
        </div>

    </div>
</div>
