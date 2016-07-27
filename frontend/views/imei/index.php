<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ImeiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imeis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imei-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Imei', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'imei_id',
            'warehouse_current',
            'warehouse_destiny',
            'master_id',
            'pallet_id',
            // 'status_id',
            // 'product_id',
            // 'code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
