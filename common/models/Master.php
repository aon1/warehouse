<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master".
 *
 * @property integer $master_id
 * @property integer $warehouse_current
 * @property integer $warehouse_destiny
 * @property integer $pallet_id
 * @property integer $status_id
 * @property string $code
 *
 * @property Imei[] $imeis
 * @property Pallet $pallet
 * @property Status $status
 * @property Warehouse $warehouseCurrent
 * @property Warehouse $warehouseDestiny
 */
class Master extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_current', 'warehouse_destiny', 'pallet_id', 'status_id', 'code'], 'required'],
            [['warehouse_current', 'warehouse_destiny', 'pallet_id', 'status_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['pallet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pallet::className(), 'targetAttribute' => ['pallet_id' => 'pallet_id']],
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
            'master_id' => 'Master',
            'warehouse_current' => 'Warehouse Current',
            'warehouse_destiny' => 'Warehouse Destiny',
            'pallet_id' => 'Pallet',
            'status_id' => 'Status',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImeis()
    {
        return $this->hasMany(Imei::className(), ['master_id' => 'master_id', 'warehouse_current' => 'warehouse_current', 'warehouse_destiny' => 'warehouse_destiny', 'pallet_id' => 'pallet_id', 'status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPallet()
    {
        return $this->hasOne(Pallet::className(), ['pallet_id' => 'pallet_id']);
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
