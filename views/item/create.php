<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\AuthItem */
/* @var $context vthang87\authmanager\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('authmanager', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
	
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
