<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property integer $warehouse_id
 * @property string $label
 *
 * @property Imei[] $imeis
 * @property Imei[] $imeis0
 * @property Master[] $masters
 * @property Master[] $masters0
 * @property Pallet[] $pallets
 * @property Pallet[] $pallets0
 * @property WarehouseLimits[] $warehouseLimits
 * @property WarehouseLimits[] $warehouseLimits0
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
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
            'warehouse_id' => 'Warehouse ID',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImeis()
    {
        return $this->hasMany(Imei::className(), ['warehouse_current' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImeis0()
    {
        return $this->hasMany(Imei::className(), ['warehouse_destiny' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasters()
    {
        return $this->hasMany(Master::className(), ['warehouse_current' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasters0()
    {
        return $this->hasMany(Master::className(), ['warehouse_destiny' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPallets()
    {
        return $this->hasMany(Pallet::className(), ['warehouse_current' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPallets0()
    {
        return $this->hasMany(Pallet::className(), ['warehouse_destiny' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLimits()
    {
        return $this->hasMany(WarehouseLimits::className(), ['warehouse_origin_id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLimits0()
    {
        return $this->hasMany(WarehouseLimits::className(), ['warehouse_target_id' => 'warehouse_id']);
    }
}
