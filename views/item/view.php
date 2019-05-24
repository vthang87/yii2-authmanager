<?php

use vthang87\authmanager\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\AuthItem */
/* @var $context vthang87\authmanager\components\ItemController */

$context                       = $this->context;
$labels                        = $context->labels();
$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager',$labels['Items']),'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="auth-item-view">
    <h1><?=Html::encode($this->title);?></h1>
    <p>
        <?=Html::a(Yii::t('authmanager','Update'),['update','id' => $model->name],['class' => 'btn btn-primary']);?>
        <?=Html::a(Yii::t('authmanager','Delete'),['delete','id' => $model->name],[
            'class'        => 'btn btn-danger',
            'data-confirm' => Yii::t('authmanager','Are you sure to delete this item?'),
            'data-method'  => 'post',
        ]);?>
        <?=Html::a(Yii::t('authmanager','Create'),['create'],['class' => 'btn btn-success']);?>
    </p>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title"><?=Yii::t('authmanager','Information');?></h3></div>
                <div class="panel-body">
                    <?=
                    DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'name',
                            'description:ntext',
                            'ruleName',
                            'data:ntext',
                        ],
                        'template'   => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title"><?=Yii::t('authmanager','Assignment');?></h3></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="available"
                           placeholder="<?=Yii::t('authmanager','Search for available');?>">
                    <select multiple size="20" class="form-control list" data-target="available"></select>
                </div>
                <div class="col-sm-2 text-center">
                    <br><br>
                    <?=Html::a('<i class="fa fa-angle-double-right"></i>' . $animateIcon,['assign','id' => $model->name],[
                        'class'       => 'btn btn-success btn-assign',
                        'data-target' => 'available',
                        'title'       => Yii::t('authmanager','Assign'),
                    ]);?><br><br>
                    <?=Html::a('<i class="fa fa-angle-double-left"></i>' . $animateIcon,['remove','id' => $model->name],[
                        'class'       => 'btn btn-danger btn-assign',
                        'data-target' => 'assigned',
                        'title'       => Yii::t('authmanager','Remove'),
                    ]);?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?=Yii::t('authmanager','Search for assigned');?>">
                    <select multiple size="20" class="form-control list" data-target="assigned"></select>
                </div>
            </div>
        </div>
    </div>
</div>
