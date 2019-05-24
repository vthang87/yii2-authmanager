<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vthang87\authmanager\components\RouteRule;
use vthang87\authmanager\AutocompleteAsset;
use yii\helpers\Json;
use vthang87\authmanager\components\Configs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context vthang87\authmanager\components\ItemController */

$context = $this->context;
$labels  = $context->labels();
$rules   = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><?=$this->title?></h3></div>
        <div class="panel-body">
			<?php $form = ActiveForm::begin(['id' => 'item-form']); ?>
            <div class="row">
                <div class="col-sm-6">
					<?=$form->field($model,'name')->textInput(['maxlength' => 64])?>
					
					<?=$form->field($model,'description')->textarea(['rows' => 2])?>
                </div>
                <div class="col-sm-6">
					<?=$form->field($model,'ruleName')->textInput(['id' => 'rule_name'])?>
					
					<?=$form->field($model,'data')->textarea(['rows' => 6])?>
                </div>
            </div>
            <div class="form-group">
				<?php
				echo Html::submitButton($model->isNewRecord ? Yii::t('authmanager','Create') : Yii::t('authmanager','Update'),[
					'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
					'name'  => 'submit-button',
				])
				?>
            </div>
			
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
