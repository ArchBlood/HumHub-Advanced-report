<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\report\models\forms\ReportUserForm;
use humhub\modules\user\models\User;

class ReportUserModal extends Widget
{
    public User $user;

    public function run()
    {
        return $this->render('ReportUserModal', [
            'user' => $this->user,
            'model' => new ReportUserForm()
        ]);
    }
}