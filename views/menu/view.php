<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\Menu */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager','Menu'),'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">
	
	
    <h1><?=Html::encode($this->title)?></h1>

    <p>
		<?=Html::a(Yii::t('authmanager','Update'),['update','id' => $model->id],['class' => 'btn btn-primary'])?>
		<?=
		Html::a(Yii::t('authmanager','Delete'),['delete','id' => $model->id],[
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method'  => 'post',
			],
		])
		?>
    </p>
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><?=Yii::t('authmanager','Information');?></h3></div>
        <div class="panel-body">
			<?=
			DetailView::widget([
				'model'      => $model,
				'attributes' => [
					'menuParent.name:text:Parent',
					'name',
					'route',
					'order',
				],
			])
			?>
        </div>
    </div>
</div>
