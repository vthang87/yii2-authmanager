<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\Menu */

$this->title = Yii::t('authmanager', 'Create Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
	

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
