<?php

namespace app\services;

use Yii;

class MailService
{
    /**
     * @return void
     */
    public function sendSuccessEmail()
    {
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('to@domain.com')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
            ->send();
    }
}
