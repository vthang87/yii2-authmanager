<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel vthang87\authmanager\models\searchs\Menu */

$this->title                   = Yii::t('authmanager','Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">
	
	<?php Pjax::begin(); ?>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'toolbar'      => [
			[
				'content' =>
					Html::a('<i class="fa fa-plus"></i>',['create'],[
						'class' => 'btn btn-success',
						'title' => Yii::t('authmanager','Add Menu'),
						'type'  => 'button',
					]) . ' ' .
					Html::a('<i class="fa fa-refresh"></i>',['index'],[
						'data-pjax' => 0,
						'class'     => 'btn btn-default',
						'title'     => Yii::t('authmanager','Reset Grid'),
					]),
			],
		],
		'panel'        => [
			'heading' => $this->title,
			'type'    => GridView::TYPE_PRIMARY,
		],
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'menuParent.name',
				'filter'    => Html::activeTextInput($searchModel,'parent_name',[
					'class' => 'form-control',
					'id'    => null,
				]),
				'label'     => Yii::t('authmanager','Parent'),
			],
			'route',
			'order',
			['class' => \kartik\grid\ActionColumn::class],
		],
	]);
	?>
	<?php Pjax::end(); ?>

</div>
