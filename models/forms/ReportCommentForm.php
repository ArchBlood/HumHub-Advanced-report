<?php

namespace humhub\modules\report\models\forms;

use humhub\modules\comment\models\Comment;
use humhub\modules\report\models\ReportComment;

class ReportCommentForm extends AbstractReportForm
{
    public int $commentId;

    public function rules(): array
    {
        return [
            [['commentId'], 'required'],
            [['reason'], 'safe'],
            [['commentId'], 'requiredReason']
        ];
    }

    public function save(): bool
    {
        $report = new ReportComment();
        $report->comment_id = $this->commentId;
        $report->reason = $this->reason;

        return $report->save();
    }

    public function getComment(): Comment
    {
        return Comment::findOne(['id' => $this->commentId]);
    }


}