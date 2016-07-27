<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imei".
 *
 * @property integer $imei_id
 * @property integer $warehouse_current
 * @property integer $warehouse_destiny
 * @property integer $master_id
 * @property integer $pallet_id
 * @property integer $status_id
 * @property integer $product_id
 * @property string $code
 *
 * @property Master $master
 * @property Product $product
 * @property Warehouse $warehouseCurrent
 * @property Warehouse $warehouseDestiny
 */
class Imei extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imei';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_current', 'warehouse_destiny', 'master_id', 'pallet_id', 'status_id', 'product_id', 'code'], 'required'],
            [['warehouse_current', 'warehouse_destiny', 'master_id', 'pallet_id', 'status_id', 'product_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['master_id', 'warehouse_current', 'warehouse_destiny', 'pallet_id', 'status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Master::className(), 'targetAttribute' => ['master_id' => 'master_id', 'warehouse_current' => 'warehouse_current', 'warehouse_destiny' => 'warehouse_destiny', 'pallet_id' => 'pallet_id', 'status_id' => 'status_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
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
            'imei_id' => 'IMEI',
            'warehouse_current' => 'Warehouse Current',
            'warehouse_destiny' => 'Warehouse Destiny',
            'master_id' => 'Master',
            'pallet_id' => 'Pallet',
            'status_id' => 'Status',
            'product_id' => 'Product',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaster()
    {
        return $this->hasOne(Master::className(), ['master_id' => 'master_id', 'warehouse_current' => 'warehouse_current', 'warehouse_destiny' => 'warehouse_destiny', 'pallet_id' => 'pallet_id', 'status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
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
