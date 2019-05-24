<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this  yii\web\View */
/* @var $model vthang87\authmanager\models\BizRule */

$this->title = Yii::t('authmanager', 'Update Rule') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', 'Rules'), 'url' => ['index']];
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
