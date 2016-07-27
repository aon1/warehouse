<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse_limits".
 *
 * @property integer $warehouse_limits_id
 * @property integer $warehouse_origin_id
 * @property integer $warehouse_target_id
 * @property string $limit_1
 *
 * @property Warehouse $warehouseOrigin
 * @property Warehouse $warehouseTarget
 */
class WarehouseLimits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_limits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_origin_id', 'warehouse_target_id', 'limitation'], 'required'],
            [['warehouse_origin_id', 'warehouse_target_id'], 'integer'],
            [['limitation'], 'number'],
            [['warehouse_origin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_origin_id' => 'warehouse_id']],
            [['warehouse_target_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_target_id' => 'warehouse_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'warehouse_limits_id' => 'Warehouse Limits ID',
            'warehouse_origin_id' => 'Warehouse Origin ID',
            'warehouse_target_id' => 'Warehouse Target ID',
            'limitation' => 'limitation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOrigin()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_origin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseTarget()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_target_id']);
    }
}
