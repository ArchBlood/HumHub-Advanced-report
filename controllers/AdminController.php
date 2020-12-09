<?php

namespace humhub\modules\report\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\report\models\ReportComment;
use humhub\modules\report\models\ReportPost;
use humhub\modules\report\models\ReportUser;
use yii\data\Pagination;

class AdminController extends Controller
{

    /**
     * Render admin only page
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionViewPosts()
    {
        $query = ReportPost::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $reports = $query->orderBy('created_at')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('posts', [
            'reports' => $reports,
            'activePost' => 'active',
            'postsCount' => $query->count(),
            'commentsCount' => ReportComment::find()->count(),
            'usersCount' => ReportUser::find()->count(),
            'pagination' => $pagination
        ]);
    }

    public function actionViewComments()
    {
        $query = ReportComment::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $reports = $query->orderBy('created_at')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('comments', [
            'reports' => $reports,
            'activeComment' => 'active',
            'postsCount' => ReportPost::find()->count(),
            'commentsCount' => $query->count(),
            'usersCount' => ReportUser::find()->count(),
            'pagination' => $pagination
        ]);
    }

    public function actionViewUsers()
    {
        $query = ReportUser::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $reports = $query->orderBy('created_at')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('users', [
            'reports' => $reports,
            'activeUser' => 'active',
            'postsCount' => ReportPost::find()->count(),
            'commentsCount' => ReportComment::find()->count(),
            'usersCount' => $query->count(),
            'pagination' => $pagination
        ]);
    }

}

