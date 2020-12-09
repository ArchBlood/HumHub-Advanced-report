<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\post\models\Post;
use humhub\modules\report\models\ReportPost;

class ReportPostWidget extends Widget
{
    private Post $post;

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function run()
    {
        if (ReportPost::canReport($this->post)) {
            return $this->render(
                'ReportPostLink',
                [
                    'post' => $this->getPost()
                ]
            );
        }
    }
}