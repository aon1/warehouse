<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WarehouseLimitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Warehouse Limits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-limits-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Warehouse Limits', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'warehouse_limits_id',
            'warehouse_origin_id',
            'warehouse_target_id',
            'limit_1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
