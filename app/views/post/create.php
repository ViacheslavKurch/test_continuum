<?php

/**
 * @var \App\Model\Post $post
 * @var string $pageTitle
 */

?>

<h1><?= $pageTitle ?></h1>

<div class="row">
    <div class="col-md-6">
        <form method="POST" action="/post">
            <input type="hidden" name="_method" value="POST" />
            <div class="form-group">
                <label>Post title</label>
                <input type="text" class="form-control" name="title" value="">
            </div>
            <div class="form-group">
                <label>Post text</label>
                <textarea name="text" class="form-control" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-dark btn-sm    ">Save</button>
        </form>
    </div>
</div>