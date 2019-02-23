<?php

/**
 * @var \App\Model\Post $post
 * @var string $pageTitle
 */

?>

<h1>
    <?= $pageTitle ?>
</h1>

<div class="card mb-3">
    <div class="card-header">
        Post `<?= $post->getId()?>`
    </div>
    <div class="card-body">
        <h5 class="card-title">
            <?= $post->getTitle() ?>
        </h5>
        <div class="card-text">
            <?= $post->getText() ?>
        </div>
    </div>
    <div class="card-footer">
        <a href="/post/<?= $post->getId() ?>/edit" class="btn btn-dark btn-sm">Edit</a>

        <form method="POST" action="/post/<?= $post->getId() ?>" style="display: inline;">
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" class="btn btn-dark btn-sm">Delete</button>
        </form>
    </div>
</div>