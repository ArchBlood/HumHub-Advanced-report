<?php
use humhub\libs\Html;
use yii\helpers\Url;
?>
<li>
    <a data-post-id="<?= $post->id ?>" href="#" class="reportPostLink">
        <i class="fa fa-exclamation-circle"></i> <?= Yii::t('ReportModule.link', "Report post"); ?>
    </a>
</li>
<?= Html::beginTag('script') ?>
    $('.reportPostLink').off('click').on('click', function (evt) {

        evt.preventDefault();
        var contentId = $(this).data('post-id');

        $.ajax('<?= Url::to(['/report/report/post']); ?>', {
            method: 'POST',
            dataType: 'json',
            data: { 'ReportPostForm[postId]': contentId },
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