<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property string $code
 * @property string $comercial_name
 * @property string $unitary_price
 *
 * @property Imei[] $imeis
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'comercial_name', 'unitary_price'], 'required'],
            [['unitary_price'], 'number'],
            [['code'], 'string', 'max' => 50],
            [['comercial_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'code' => 'Code',
            'comercial_name' => 'Comercial Name',
            'unitary_price' => 'Unitary Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImeis()
    {
        return $this->hasMany(Imei::className(), ['product_id' => 'product_id']);
    }
}
