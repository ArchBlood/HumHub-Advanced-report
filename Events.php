<?php

namespace  humhub\modules\report;

use humhub\modules\report\widget\ReportPostWidget;
use humhub\modules\report\widget\ReportUserWidget;
use Yii;
use yii\helpers\Url;

class Events
{
    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onWallEntryControlsInit($event)
    {
        $event->sender->addWidget(ReportPostWidget::class, [
            'post' => $event->sender->object
        ]);
    }

    public static function onProfileHeaderControlsInit($event)
    {
        $event->sender->addWidget(ReportUserWidget::class, [
            'user' => $event->sender->user
        ]);
    }

    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Report',
            'url' => Url::to(['/report/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-exclamation-circle"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'report' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ]);
    }
}
