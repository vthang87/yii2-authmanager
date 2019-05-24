<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this  yii\web\View */
/* @var $model vthang87\authmanager\models\BizRule */

$this->title = Yii::t('authmanager', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
	
	
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
