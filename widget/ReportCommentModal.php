<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\comment\models\Comment;
use humhub\modules\report\models\forms\ReportCommentForm;

class ReportCommentModal extends Widget
{
    public Comment $comment;

    public function run()
    {
        return $this->render('ReportCommentModal', [
            'comment' => $this->comment,
            'model' => new ReportCommentForm()
        ]);
    }
}