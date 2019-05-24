<?php

use vthang87\authmanager\FontAwesomeAsset;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;
use vthang87\authmanager\models\Menu;
use yii\helpers\Json;
use vthang87\authmanager\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
FontAwesomeAsset::register($this);
$opts = Json::htmlEncode([
	'menus'  => Menu::getMenuSource(),
	'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>

<div class="menu-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><?=$this->title?></h3></div>
        <div class="panel-body">
			<?php $form = ActiveForm::begin(); ?>
			<?=Html::activeHiddenInput($model,'parent',['id' => 'parent_id']);?>
            <div class="row">
                <div class="col-sm-6">
					<?=$form->field($model,'name')->textInput(['maxlength' => 128])?>
					
					<?=$form->field($model,'parent_name')->textInput(['id' => 'parent_name'])?>
					
					<?=$form->field($model,'route')->textInput(['id' => 'route'])?>
                </div>
                <div class="col-sm-6">
					<?=$form->field($model,'order')->input('number')?>
					
					<?php
					$format = <<< SCRIPT
        function format(icon) {
            return '<i class="fa fa-'+ icon.id +'"></i>' + '&nbsp;&nbsp;' + icon.text;
        }
SCRIPT;
					$escape = new JsExpression("function(m) { return m; }");
					$this->registerJs($format,View::POS_HEAD);
					?>
					<?=$form->field($model,'data')->widget(\kartik\widgets\Select2::class,[
						'theme'         => \kartik\select2\Select2::THEME_DEFAULT,
						'data'          => \vthang87\authmanager\components\FontAwesomeUtil::AVAILABLE_FONT_LIST,
						'options'       => ['placeholder' => Yii::t('authmanager','Select')],
						'pluginOptions' => [
							'templateResult'    => new JsExpression('format'),
							'templateSelection' => new JsExpression('format'),
							'escapeMarkup'      => $escape,
							'allowClear'        => true,
						],
					]);?>
                </div>
            </div>

            <div class="form-group">
				<?=
				Html::submitButton($model->isNewRecord ? Yii::t('authmanager','Create') : Yii::t('authmanager','Update'),[
					'class' => $model->isNewRecord
						? 'btn btn-success' : 'btn btn-primary',
				])
				?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
