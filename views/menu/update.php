<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\Menu */

$this->title = Yii::t('authmanager', 'Update Menu') . ': ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('authmanager', 'Update');
?>
<div class="menu-update">
	

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
