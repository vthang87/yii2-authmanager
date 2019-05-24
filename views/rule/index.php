<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

/* @var $this  yii\web\View */
/* @var $model vthang87\authmanager\models\BizRule */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel vthang87\authmanager\models\searchs\BizRule */

$this->title = Yii::t('authmanager', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
	
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'toolbar'      => [
	        [
		        'content' =>
			        Html::a('<i class="fa fa-plus"></i>',['create'],[
				        'class' => 'btn btn-success',
				        'title' => Yii::t('authmanager','Add'),
				        'type'  => 'button',
			        ]) . ' ' .
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('authmanager', 'Name'),
            ],
            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]);
    ?>

</div>
