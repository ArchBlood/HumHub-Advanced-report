<?php
use humhub\libs\Html;
use yii\helpers\Url;
use humhub\modules\ui\icon\widgets\Icon;
?>
<div class="report-dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"
       aria-label="<?= Yii::t('base', 'Toggle comment menu'); ?>" aria-haspopup="true">
        <?= Icon::get('dropdownToggle') ?>
    </a>

    <ul class="dropdown-menu pull-right">
        <li>
            <a data-user-id="<?= $user->id ?>" href="#" class="reportUserLink">
                <i class="fa fa-exclamation-circle"></i> <?= Yii::t('ReportModule.link', "Report user"); ?>
            </a>
        </li>
    </ul>
</div>
<style>
    .report-dropdown {
        display: inline-block;
        padding: 10px;
    }
</style>
<?= Html::beginTag('script') ?>
    $('.reportUserLink').off('click').on('click', function (evt) {

        evt.preventDefault();
        var contentId = $(this).data('user-id');

        $.ajax('<?= Url::to(['/report/report/user']); ?>', {
            method: 'POST',
            dataType: 'json',
            data: { 'ReportUserForm[reportedUserId]': contentId },
            beforeSend: function () {
                setModalLoader();
                $('#globalModal').modal('show');
            },
            success: function (result) {
                $('#globalModal').html(result.content);
            }
        });
    });
<?= Html::endTag('script') ?>