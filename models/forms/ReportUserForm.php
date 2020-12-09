<?php

namespace humhub\modules\report\models\forms;

use humhub\modules\report\models\ReportUser;
use humhub\modules\user\models\User;

class ReportUserForm extends AbstractReportForm
{
    public int $reportedUserId;

    public function rules(): array
    {
        return [
            [['reportedUserId'], 'required'],
            [['reason'], 'safe'],
            [['reportedUserId'], 'requiredReason']
        ];
    }

    public function save(): bool
    {
        $report = new ReportUser();
        $report->reported_user_id = $this->reportedUserId;
        $report->reason = $this->reason;

        return $report->save();
    }

    public function getReportedUser(): User
    {
        return User::findOne(['id' => $this->reportedUserId]);
    }
}