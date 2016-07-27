<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pallets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pallet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pallet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pallet_id',
            'warehouse_current',
            'warehouse_destiny',
            'status_id',
            'code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
