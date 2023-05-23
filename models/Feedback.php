<?php

namespace app\models;

use yii\db\ActiveRecord;

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
            [['comment'], 'string'],
            [['created_at'], 'safe'],
            [['screenshot_path'], 'string', 'max' => 255],
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
            'screenshot_path' => 'Screenshot Path',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }
}
