<?php
use yii\helpers\Url;
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Reports</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?= $activePost ?>"><a href="<?= Url::to(['/report/admin/view-posts']); ?>">Posts <span class="badge"><?= $postsCount ?></span></a></li>
                <li class="<?= $activeComment ?>"><a href="<?= Url::to(['/report/admin/view-comments']); ?>">Comments <span class="badge"><?= $commentsCount ?></span></a></li>
                <li class="<?= $activeUser ?>"><a href="<?= Url::to(['/report/admin/view-users']); ?>">User profiles <span class="badge"><?= $usersCount ?></span></a></li>
            </ul>
        </div>
    </div>
</nav>