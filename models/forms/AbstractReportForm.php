<?php

namespace humhub\modules\report\models\forms;

use humhub\modules\report\models\AbstractReport;
use Yii;
use yii\base\Model;

abstract class AbstractReportForm extends Model
{
    public ?int $reason = null;

    public function getReasons(): array
    {
        return [
            AbstractReport::REASON_NOT_BELONG => Yii::t('ReportModule.models', "Doesn't belong to space"),
            AbstractReport::REASON_OFFENSIVE => Yii::t('ReportModule.models', "Offensive"),
            AbstractReport::REASON_SPAM => Yii::t('ReportModule.models', "SPAM")
        ];
    }

    public function requiredReason($attribute, $model)
    {
        if (empty($this->reason)) {
            $this->addError('reason', Yii::t('ReportModule.modal', 'Please provide a reason, why you want to report this content.'));
        }
    }
}