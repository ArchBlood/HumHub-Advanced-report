<?php

namespace humhub\modules\report\models;

use humhub\modules\comment\models\Comment;
use humhub\modules\user\models\User;
use Yii;
/**
 * This is the model class for table "report_comment".
 *
 * @property integer $id
 * @property integer $comment_id
 * @property integer $reason
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @package humhub.modules.report.models
 */
class ReportComment extends AbstractReport
{

    public static function tableName(): string
    {
        return 'report_comment';
    }

    public function rules(): array
    {
        return [
            [['comment_id', 'reason'], 'required']
        ];
    }

    public static function canReport(Comment $comment, $userId = null): bool
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        $user = ($userId != null) ? User::findOne(['id' => $userId]) : Yii::$app->user->getIdentity();

        if ($user == null || $user->isSystemAdmin()) {
            return false;
        }

        // Can't report own content
        if ($comment->created_by == $user->id) {
            return false;
        }

        // Check if post exists
        if (ReportComment::findOne(['comment_id' => $comment->id, 'created_by' => $user->id]) !== null) {
            return false;
        }

        // Don't report system admin content
        if (User::findOne(['id' => $comment->created_by])->isSystemAdmin()) {
            return false;
        }

        return true;
    }

    public function getComment(): Comment
    {
        return Comment::findOne(['id' => $this->comment_id]);
    }
}