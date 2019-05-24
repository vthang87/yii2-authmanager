<?php

use kartik\grid\ActionColumn;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel vthang87\authmanager\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title                   = Yii::t('authmanager','Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
	['class' => 'yii\grid\SerialColumn'],
	$usernameField,
];
if(!empty($extraColumns)){
	$columns = array_merge($columns,$extraColumns);
}
$columns[] = [
	'class'    => ActionColumn::class,
	'template' => '{view}',
];
?>
<div class="assignment-index">
	<?php Pjax::begin(); ?>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'toolbar'      => [
			[
				'content' =>
					
					Html::a('<i class="glyphicon glyphicon-repeat"></i>',['index'],[
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
		'columns'      => $columns,
	]);
	?>
	<?php Pjax::end(); ?>

</div>
