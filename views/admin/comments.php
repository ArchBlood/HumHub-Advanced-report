<?php

use humhub\modules\content\widgets\richtext\RichText;
use humhub\widgets\GridView;
use humhub\widgets\ModalConfirm;
use humhub\widgets\TimeAgo;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\grid\DataColumn;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\modules\report\models\ReportPost;

/**
 * @var \humhub\modules\report\models\ReportComment $report;
 * @var \yii\data\Pagination $pagination
 */
?>
<div class="container-fluid">

    <?php include './protected/modules/report/views/layouts/menu.php' ?>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>Comments</strong> reported</div>
        <div class="panel-body">

        <?php if (empty($reports)) : ?>
            <br/> <br/>
            <?= Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'There are no reported comments.') ?>
            <br/> <br/>
        <?php else : ?>

        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['allModels' => $reports]),
            'tableOptions' => ['class' => 'table table-hover'],
            'columns' => [
                [
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'value' => function($report) {
                        return UserImage::widget(['user' => $report->user, 'width' => 34]);
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'label' => 'Content',
                    'format' => 'raw',
                    'value' => function($report) {
                        $result = Html::tag('p',  RichText::preview($report->comment->getContentDescription(), 60));
                        $userLink = Html::a(Html::encode($report->comment->createdBy->displayName), $report->comment->createdBy->getUrl());
                        $displayNameLink = Yii::t('ReportModule.base', 'created by :displayName',  [':displayName' => $userLink]);
                        $result .= Html::tag('small', $displayNameLink .' '. TimeAgo::widget(['timestamp' => $report->comment->created_at]), ['class' => 'media']);
                        return $result;
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'label' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Reason'),
                    'format' => 'raw',
                    'value' => function($report) {
                        return '<strong>'.  Html::encode(ReportPost::getReason($report->reason)) . '</strong>';
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'value' => function($report) {
                        return UserImage::widget(['user' => $report->user, 'width' => 34]);
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'label' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Reporter'),
                    'format' => 'raw',
                    'value' => function($report) {
                        $result = '<p>'. Html::tag('strong', Html::a(Html::encode($report->user->displayName), $report->user->getUrl())).'</p>';
                        $result .= Html::tag('small', TimeAgo::widget(['timestamp' => $report->created_at]), ['class' => 'media']);
                        return $result;
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'value' => function($report) {
                        $approve = ModalConfirm::widget([
                            'uniqueID' => $report->id,
                            'title' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', '<strong>Approve</strong> content'),
                            'linkTooltipText' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Approve'),
                            'message' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Do you really want to approve this post?'),
                            'buttonTrue' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Approve'),
                            'buttonFalse' => Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Cancel'),
                            'cssClass' => 'btn btn-success btn-sm tt',
                            'linkContent' => '<i class="fa fa-check-square-o"></i>',
                            'linkHref' => Url::to(["//report/report/appropriate", 'id' => $report->id, 'resource' => 'comment']),
                        ]);

                        $review =  Html::a('<i aria-hidden="true" class="fa fa-eye"></i>', $report->comment->content->getUrl(), [
                            'class' => 'btn btn-sm btn-primary tt',
                            'title' =>  Yii::t('ReportModule.widgets_views_reportContentAdminGrid', 'Review'),
                            'data-ui-loader' => '1'
                        ]);

                        return $approve .' '.$review;
                    }
                ],
            ]
        ]) ?>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>

        </div>
    </div>
    <?php endif; ?>
</div>