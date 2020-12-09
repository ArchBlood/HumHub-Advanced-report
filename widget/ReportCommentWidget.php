<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\comment\models\Comment;
use humhub\modules\report\models\ReportComment;

class ReportCommentWidget extends Widget
{
    private Comment $comment;

    public function getComment(): Comment
    {
        return $this->comment;
    }

    public function setComment(Comment $comment): void
    {
        $this->comment = $comment;
    }

    public function run()
    {
        if (ReportComment::canReport($this->comment)) {
            return $this->render(
                'ReportCommentLink',
                [
                    'comment' => $this->getComment()
                ]
            );
        }

        return null;
    }
}