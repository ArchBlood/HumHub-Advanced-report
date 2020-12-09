<?php

namespace humhub\modules\report\controllers;

use humhub\components\Controller;
use humhub\modules\report\models\forms\ReportCommentForm;
use humhub\modules\report\models\forms\ReportPostForm;
use humhub\modules\report\models\forms\ReportUserForm;
use humhub\modules\report\models\ReportComment;
use humhub\modules\report\models\ReportPost;
use humhub\modules\report\models\ReportUser;
use humhub\modules\report\widget\ReportCommentModal;
use humhub\modules\report\widget\ReportPostModal;
use humhub\modules\report\widget\ReportUserModal;
use yii\helpers\Url;
use yii\web\Response;
use Yii;

class ReportController extends Controller
{
    public function actionPost(): Response
    {
        $this->forcePostRequest();

        $form = new ReportPostForm();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->save();
            $json['success'] = true;
        } else {
            $json['success'] = false;
            $json['content'] = ReportPostModal::widget(['post' => $form->getPost()]);
        }

        return $this->asJson($json);
    }

    public function actionComment(): Response
    {
        $this->forcePostRequest();

        $form = new ReportCommentForm();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->save();
            $json['success'] = true;
        } else {
            $json['success'] = false;
            $json['content'] = ReportCommentModal::widget(['comment' => $form->getComment()]);
        }

        return $this->asJson($json);
    }

    public function actionUser(): Response
    {
        $this->forcePostRequest();

        $form = new ReportUserForm();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->save();
            $json['success'] = true;
        } else {
            $json['success'] = false;
            $json['content'] = ReportUserModal::widget(['user' => $form->getReportedUser()]);
        }

        return $this->asJson($json);
    }

    public function actionAppropriate()
    {
        $this->forcePostRequest();

        $reportId = Yii::$app->request->get('id');
        $resource = Yii::$app->request->get('resource') ?? null;

        switch ($resource) {
            case 'post':
                $report = ReportPost::findOne(['id' => $reportId]);
                break;
            case 'comment':
                $report = ReportComment::findOne(['id' => $reportId]);
                break;
            case 'user':
                $report = ReportUser::findOne(['id' => $reportId]);
                break;
            default:
                return $this->htmlRedirect(Url::to(['/report/admin']));
        }

        $report->delete();

        return $this->htmlRedirect(Url::to(
            [sprintf('/report/admin/view-%ss', $resource)]
        ));
    }
}