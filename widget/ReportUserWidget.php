<?php

namespace humhub\modules\report\widget;

use humhub\components\Widget;
use humhub\modules\report\models\ReportUser;
use humhub\modules\user\models\User;

class ReportUserWidget extends Widget
{
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function run()
    {
        if (ReportUser::canReport($this->user)) {
            return $this->render(
                'ReportUserLink',
                [
                    'user' => $this->getUser()
                ]
            );
        }

        return null;
    }
}