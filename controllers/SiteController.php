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

            $fileName = 'upload/' . date("YmdHis") . '.jpg';
            $model->file_name = $fileName;
            $model->ip = Yii::$app->request->post('ip');
            $model->request_time = Yii::$app->request->post('time');

            if ($model->save()) {
                $this->checkOrCreateDir('upload');
                file_put_contents($fileName, base64_decode(Yii::$app->request->post('image')));
                $model->sendEmail($model->comment, $model->file_name);

                return true;
            } else {
                return false;
            }
        }

        return $this->render('index');
    }

    /**
     * @param string $dirName
     * @return void
     */
    public function checkOrCreateDir(string $dirName)
    {
        if (!file_exists($dirName)) {
            mkdir($dirName, 0777, true);
        }
    }
}
