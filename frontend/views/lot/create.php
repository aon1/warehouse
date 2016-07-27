<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Imei */

$this->title = 'Create Lot';
$this->params['breadcrumbs'][] = ['label' => 'Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 

    	$form = ActiveForm::begin();

	    echo $form->field($warehouse, 'warehouse_id')
	        ->dropDownList(
	            $items,
	            ['prompt'=>'Choose a destination',
	            'onchange'=>'
	                $.get("'.Url::toRoute('warehouse/lists').'", {id:$(this).val()})
	                .done(function(data) {
                            $("#'.Html::getInputId($imei, 'imei_id').'").html(data);
                        }
                    );
	            '
	            ]);

	    // echo $form->field($imei, 'imei_id')->dropDownList([
	    // 	'prompt'=>'Choose a destination',
	    // 	]);

	    echo $form->field($imei, 'imei_id')->widget(Select2::classname(), [
		    'data' => $data,
		    'language' => 'pt_br',
		    'options' => ['placeholder' => 'Choose a destination'],
		    'pluginOptions' => [
		        'allowClear' => true
		    ],
		]);

	    ActiveForm::end();
    ?>
</div>

<div id="result"></div>

<div id="imei-search"></div>
