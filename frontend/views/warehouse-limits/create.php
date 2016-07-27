<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WarehouseLimits */

$this->title = 'Create Warehouse Limits';
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Limits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-limits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
