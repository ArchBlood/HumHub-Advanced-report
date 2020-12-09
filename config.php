<?php

use humhub\modules\report\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\user\widgets\ProfileHeaderControls;

return [
	'id' => 'report',
	'class' => 'humhub\modules\report\Module',
	'namespace' => 'humhub\modules\report',
	'events' => [
		[
			'class' => WallEntryControls::class,
			'event' => WallEntryControls::EVENT_INIT,
			'callback' => [Events::class, 'onWallEntryControlsInit'],
		],
        [
            'class' => ProfileHeaderControls::class,
            'event' => ProfileHeaderControls::EVENT_INIT,
            'callback' => [Events::class, 'onProfileHeaderControlsInit'],
        ],
		[
			'class' => AdminMenu::class,
			'event' => AdminMenu::EVENT_INIT,
			'callback' => [Events::class, 'onAdminMenuInit']
		],
	],
];
