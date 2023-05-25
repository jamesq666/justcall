<?php

namespace app\services;

use Yii;

class MailService
{
    /**
     * @return void
     */
    public function sendSuccessEmail(string $text, string $fileName)
    {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Новое обращение формы обратной связи')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody($text)
            ->attach($fileName)
            ->send();
    }
}
