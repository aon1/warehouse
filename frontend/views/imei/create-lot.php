<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\Imei */

$this->title = 'Transfer IMEIs';
$this->params['breadcrumbs'][] = ['label' => 'Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 

    	$form = ActiveForm::begin([
    		// 'type' => ActiveForm::TYPE_INLINE, 
        	'method' => 'GET',
        	'action' => Url::to(['imei/addpallet']), 
        	'enableClientScript' => true,
        ]);

	    echo $form->field($model, 'warehouse_current')->
	    	dropDownList($warehouseCurrent,
	    		['id'=>'warehouse_current_id',
	    		'prompt'=>'Choose an origin',
	    	]);

	    echo $form->field($model, 'warehouse_destiny')->widget(DepDrop::classname(), [
	    	'type'=>DepDrop::TYPE_SELECT2,
		    'options'=>['id'=>'warehouse_destiny_id'],
		    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
		    'pluginOptions'=>[
		        'depends'=>['warehouse_current_id'],
		        'placeholder'=>'Choose a destination',
		        'url'=>Url::to(['/warehouse/list'])
		    ]
		]);

		echo $form->field($model, 'pallet_id')->widget(DepDrop::classname(), [
	    	'type'=>DepDrop::TYPE_SELECT2,
		    'options'=>['id'=>'pallet_id'],
		    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
		    'pluginOptions'=>[
		        'depends'=>['warehouse_current_id'],
		        'placeholder'=>'Choose a pallet',
		        'url'=>Url::to(['/pallet/list'])
		    ]
		]);

		echo $form->field($model, 'master_id')->widget(DepDrop::classname(), [
	    	'type'=>DepDrop::TYPE_SELECT2,
		    'options'=>['id'=>'master_id'],
		    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
		    'pluginOptions'=>[
		        'depends'=>['warehouse_current_id','pallet_id'],
		        'placeholder'=>'Choose a master',
		        'url'=>Url::to(['/master/list'])
		    ]
		]);

		echo $form->field($model, 'code')->widget(DepDrop::classname(), [
			// 'options' => ['multiple' => true],
			'type'=>DepDrop::TYPE_SELECT2,
			'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
		    'pluginOptions'=>[
		        'depends'=>['warehouse_current_id', 'pallet_id', 'master_id'],
		        'placeholder'=>'Select an IMEI',
		        'url'=>Url::to(['/imei/list']),
		    ]
		]); ?>

		<div class="form-group">
		<br>
    	
    	<?= Html::submitButton('Transfer Pallet',['name'=>'pallet', 'value' => 'pallet', 'class' => 'btn btn-success','data-pjax' => 0]) ?>
    	<?= Html::submitButton('Transfer Master',['name'=>'master', 'value' => 'master', 'class' => 'btn btn-success','data-pjax' => 0]) ?>
    	<?= Html::submitButton('Transfer IMEI',['name'=>'imei', 'value' => 'imei', 'class' => 'btn btn-success','data-pjax' => 0]) ?>

    	</div>

	    <?php ActiveForm::end(); ?>
</div>

<div id="result"></div>

<div id="imei-search"></div>
