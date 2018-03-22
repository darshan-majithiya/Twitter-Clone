<div class="container homeContainer">
    <div class="row">
        <div class="col-md-8">
            <h2>Search Results<hr /></h2>
            <?php displayTweets('searchTweets'); ?>
        </div>
        <div class="col-md-4">
            <?php displaySearch(); ?>
            <?php postTweet(); ?>
        </div>

    </div>
</div>
