<?php

namespace humhub\modules\report\models\forms;

use humhub\modules\post\models\Post;
use humhub\modules\report\models\ReportPost;
use yii\base\Model;

class ReportPostForm extends AbstractReportForm
{
    public int $postId;

    public function rules(): array
    {
        return [
            [['postId'], 'required'],
            [['reason'], 'safe'],
            [['postId'], 'requiredReason']
        ];
    }

    public function save(): bool
    {
        $report = new ReportPost();
        $report->post_id = $this->postId;
        $report->reason = $this->reason;

        return $report->save();
    }

    public function getPost(): Post
    {
        return Post::findOne(['id' => $this->postId]);
    }
}