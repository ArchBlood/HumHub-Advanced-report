<?php

namespace humhub\modules\report;

use Yii;
use yii\helpers\Url;
use humhub\components\Module as HumHubModule;

class Module extends HumHubModule
{

    public function getConfigUrl()
    {
        return Url::to(['/report/admin']);
    }

    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

}
