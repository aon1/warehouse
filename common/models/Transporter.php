<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transporter".
 *
 * @property integer $transporter_id
 * @property string $label
 */
class Transporter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transporter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['label'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transporter_id' => 'Transporter ID',
            'label' => 'Label',
        ];
    }
}
