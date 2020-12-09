<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\humhub\modules\report\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('ReportModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("report", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t('ReportModule.base', 'Hi there {name}!', ["name" => $displayName])
    ]
])

?>

<div class="panel-heading"><strong>Report</strong> <?= Yii::t('ReportModule.base', 'overview') ?></div>

<div class="panel-body">
    <p><?= Yii::t('ReportModule.base', 'Hello World!') ?></p>

    <?=  Button::primary(Yii::t('ReportModule.base', 'Say Hello!'))->action("report.hello")->loader(false); ?></div>
