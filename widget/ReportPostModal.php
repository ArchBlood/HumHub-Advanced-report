<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\post\models\Post;
use humhub\modules\report\models\forms\ReportPostForm;

class ReportPostModal extends Widget
{
    public Post $post;

    public function run()
    {
        return $this->render('ReportPostModal', [
            'post' => $this->post,
            'model' => new ReportPostForm()
        ]);
    }
}