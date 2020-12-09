<?php

namespace humhub\modules\report\models;

use humhub\modules\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

abstract class AbstractReport extends ActiveRecord
{
    const REASON_NOT_BELONG = 1;
    const REASON_OFFENSIVE = 2;
    const REASON_SPAM = 3;

    public function behaviors(): array
    {
        return [
            BlameableBehavior::class,
            TimestampBehavior::class
        ];
    }

    public static function getReason(int $reason): string
    {
        switch ($reason) {
            case self::REASON_NOT_BELONG:
                return Yii::t('ReportModule.models', "Doesn't belong to space");
            case self::REASON_OFFENSIVE:
                return Yii::t('ReportModule.models', "Offensive");
            case self::REASON_SPAM:
                return Yii::t('ReportModule.models', "SPAM");
        }

        throw new \DomainException(sprintf('Reason with in %d not found', $reason));
    }

    public function getUser(): User
    {
        return User::findOne(['id' => $this->created_by]);
    }
}