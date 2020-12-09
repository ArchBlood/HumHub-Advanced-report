<?php
use humhub\libs\Html;
use yii\helpers\Url;
?>
<li>
    <a data-comment-id="<?= $comment->id ?>" href="#" class="reportPostLink">
        <i class="fa fa-exclamation-circle"></i> <?= Yii::t('ReportModule.link', "Report comment"); ?>
    </a>
</li>
<?= Html::beginTag('script') ?>
    $('.reportPostLink').off('click').on('click', function (evt) {

        evt.preventDefault();
        var contentId = $(this).data('comment-id');

        $.ajax('<?= Url::to(['/report/report/comment']); ?>', {
            method: 'POST',
            dataType: 'json',
            data: { 'ReportCommentForm[commentId]': contentId },
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