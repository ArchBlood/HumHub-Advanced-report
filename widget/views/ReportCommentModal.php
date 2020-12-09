<?php

use yii\helpers\Url;
use humhub\libs\Html;
use yii\widgets\ActiveForm;

/**
 * @var \humhub\modules\report\models\forms\ReportCommentForm $model
 * @var \humhub\modules\comment\models\Comment $comment
 */
?>
<div class="modal-dialog modal-dialog-small">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
                <strong>
                    <?= Yii::t('ReportModule.modal', "What's happening ?") ?>
                </strong>
            </h4>
        </div>
        <hr />
        <?php $form = ActiveForm::begin(['id' => 'report-content-form']); ?>
        <div style="visibility: hidden">
            <?php echo $form->field($model, 'commentId')->hiddenInput(['value' => $comment->id]); ?>
        </div>
        <div class="modal-body text-left">
            <?=
            $form->field($model, 'reason')->radioList($model->getReasons(), [
                'item' => function($index, $label, $name, $checked, $value) {
                    return '<label>' . Html::radio($name, $checked, ['value' => $value, 'autocomplete' => 'off']) . $label . '</label><br />';
                }
            ])
                ->label(Yii::t('ReportModule.modal', "Reason"));
            ?>
        </div>
        <hr />
        <div class="modal-footer">
            <a href="#" id="submitReport" class="btn btn-primary" data-ui-loader>
                Submit
            </a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
    <style>
        #report-content-form input {
            margin-right: 15px;
        }

        #report-content-form .modal-body {
            margin-top: -10px;
            padding-top: 0;
        }
    </style>
<?= Html::beginTag('script') ?>
    $('#submitReport').on('click', function (evt) {

        evt.preventDefault();
        var $form = $(this).closest('form');

        $.ajax('<?= Url::to(['/report/report/comment']); ?>', {
            method: 'POST',
            dataType: 'json',
            data: $form.serialize(),
            success: function (result) {
                if (result.success) {
                    $('#globalModal').modal('hide');
                } else {
                    $('#globalModal').html(result.content);
                }
            }
        });
    });
<?= Html::endTag('script') ?>