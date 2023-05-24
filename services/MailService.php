<?php

namespace app\services;

use app\models\Feedback;
use Yii;

class MailService
{
    public function __construct()
    {

    }

    /**
     * @param string $email
     * @param User $user
     * @return bool
     */
    public function sendPasswordResetRequestLetter(string $email, User $user)
    {
        $subject = 'Изменение личных данных FastBox';

        $isSentSuccessfully = Yii::$app
            ->mailer
            ->compose(
                [
                    'html' => '@common/mail/passwordResetToken-html', //TODO
                    'text' => '@common/mail/passwordResetToken-text',
                ],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => self::FROM_NAME_DEFAULT])
            ->setTo($email)
            ->setSubject($subject)
            ->send();

        return $isSentSuccessfully;
    }
}
