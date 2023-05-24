<?php

namespace app\controllers;

use app\models\Feedback;
use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->post() !== null) {

            $model = new Feedback();
            $model->comment = Yii::$app->request->post('comment');
            $model->created_at = Yii::$app->request->post('time');
            $model->ip = Yii::$app->request->post('ip');
            $model->screenshot_path = Yii::$app->request->post('image');

            if ($model->save()) {
                //TODO sendEmail
            }

            $file = time() . '.jpg';
            file_put_contents($file, base64_decode(Yii::$app->request->post('image')));
        }

        return $this->render('index');
    }
}
