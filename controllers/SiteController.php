<?php

namespace app\controllers;

use app\models\Feedback;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return bool|string
     */
    public function actionIndex()
    {
        if (!empty(Yii::$app->request->post())) {
            $model = new Feedback();
            $model->comment = Yii::$app->request->post('comment');
            $model->created_at = Yii::$app->request->post('time');
            $model->ip = Yii::$app->request->post('ip');

            $fileName = date("YmdHis") . '.jpg';
            $model->file_name = $fileName;

            if ($model->save()) {
                file_put_contents($fileName, base64_decode(Yii::$app->request->post('image')));
                $model->sendEmail($model->comment, $model->file_name);
                return true;
            } else {
                return false;
            }
        }

        return $this->render('index');
    }
}
