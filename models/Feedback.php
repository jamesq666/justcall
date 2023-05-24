<?php

namespace app\models;

use app\services\MailService;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "feedback".
 *
 * @property string comment
 * @property string ip
 * @property string file_name
 * @property string created_at
 */

class Feedback extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'string', 'max' => 2000],
            [['comment'], 'required'],
            [['created_at'], 'string'],
            [['file_name'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'file_name' => 'Screenshot Path',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return void
     */
    public function sendEmail() {
        $mailService = new MailService();
    }
}
