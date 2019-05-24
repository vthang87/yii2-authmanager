<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\AuthItem */
/* @var $context vthang87\authmanager\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('authmanager', 'Update ' . $labels['Item']) . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('authmanager', 'Update');
?>
<div class="auth-item-update">
	
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
