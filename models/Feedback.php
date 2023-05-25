<?php

namespace app\models;

use app\services\MailService;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "feedback".
 *
 * @property string comment
 * @property string file_name
 * @property string ip
 * @property string request_time
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
            [['file_name'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
            [['request_time'], 'string', 'max' => 50],
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
            'request_time' => 'Request Time',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return void
     */
    public function sendEmail(string $text, string $fileName)
    {
        (new MailService())->sendSuccessEmail($text, $fileName);
    }
}
