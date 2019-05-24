<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use vthang87\authmanager\components\RouteRule;
use vthang87\authmanager\components\Configs;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel vthang87\authmanager\models\searchs\AuthItem */
/* @var $context vthang87\authmanager\components\ItemController */

$context                       = $this->context;
$labels                        = $context->labels();
$this->title                   = Yii::t('authmanager',$labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules,$rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
	
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'toolbar'      => [
			[
				'content' =>
					Html::a('<i class="fa fa-plus"></i>',['create'],[
						'class' => 'btn btn-success',
						'title' => Yii::t('authmanager','Add'),
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
			[
				'attribute' => 'name',
				'label'     => Yii::t('authmanager','Name'),
			],
			[
				'attribute' => 'ruleName',
				'label'     => Yii::t('authmanager','Rule Name'),
				'filter'    => $rules,
			],
			[
				'attribute' => 'description',
				'label'     => Yii::t('authmanager','Description'),
			],
			['class' => \kartik\grid\ActionColumn::class],
		],
	])
	?>

</div>
