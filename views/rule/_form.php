<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model vthang87\authmanager\models\BizRule */
/* @var $form ActiveForm */
?>

<div class="auth-item-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><?=Html::encode($this->title);?></h3></div>
        <div class="panel-body">
			<?php $form = ActiveForm::begin(); ?>
			
			<?=$form->field($model,'name')->textInput(['maxlength' => 64])?>
			
			<?=$form->field($model,'className')->textInput()?>

            <div class="form-group">
				<?php
				echo Html::submitButton($model->isNewRecord ? Yii::t('authmanager','Create') : Yii::t('authmanager','Update'),[
					'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
				])
				?>
            </div>
			
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
