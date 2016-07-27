<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pallet".
 *
 * @property integer $pallet_id
 * @property integer $warehouse_current
 * @property integer $warehouse_destiny
 * @property integer $status_id
 * @property string $code
 *
 * @property Master[] $masters
 * @property Status $status
 * @property Warehouse $warehouseCurrent
 * @property Warehouse $warehouseDestiny
 */
class Pallet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_current', 'warehouse_destiny', 'status_id', 'code'], 'required'],
            [['warehouse_current', 'warehouse_destiny', 'status_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'status_id']],
            [['warehouse_current'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_current' => 'warehouse_id']],
            [['warehouse_destiny'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_destiny' => 'warehouse_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pallet_id' => 'Pallet',
            'warehouse_current' => 'Warehouse Current',
            'warehouse_destiny' => 'Warehouse Destiny',
            'status_id' => 'Status',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasters()
    {
        return $this->hasMany(Master::className(), ['pallet_id' => 'pallet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseCurrent()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_current']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseDestiny()
    {
        return $this->hasOne(Warehouse::className(), ['warehouse_id' => 'warehouse_destiny']);
    }
}
