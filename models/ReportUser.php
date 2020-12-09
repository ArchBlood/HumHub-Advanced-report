<?php

namespace humhub\modules\report\models;

use humhub\modules\comment\models\Comment;
use humhub\modules\user\models\User;
use Yii;
/**
 * This is the model class for table "report_user".
 *
 * @property integer $id
 * @property integer $reported_user_id
 * @property integer $reason
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @package humhub.modules.report.models
 */
class ReportUser extends AbstractReport
{

    public static function tableName(): string
    {
        return 'report_user';
    }

    public function rules(): array
    {
        return [
            [['reported_user_id', 'reason'], 'required']
        ];
    }

    public static function canReport(User $user, $userId = null): bool
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        $currentUser = ($userId != null) ? User::findOne(['id' => $userId]) : Yii::$app->user->getIdentity();

        if ($currentUser == null || $currentUser->isSystemAdmin()) {
            return false;
        }

        // Can't report own content
        if ($user->created_by == $currentUser->id) {
            return false;
        }

        // Check if user exists
        if (ReportUser::findOne(['reported_user_id' => $user->id, 'created_by' => $currentUser->id]) !== null) {
            return false;
        }

        // Don't report system admin content
        if ($user->isSystemAdmin()) {
            return false;
        }

        return true;
    }

    public function getReportedUser(): User
    {
        return User::findOne(['id' => $this->reported_user_id]);
    }
}