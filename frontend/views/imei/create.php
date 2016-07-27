<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Imei */

$this->title = 'Create Imei';
$this->params['breadcrumbs'][] = ['label' => 'Imeis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imei-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
