<?php

use vthang87\authmanager\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title                   = Yii::t('authmanager','Routes');
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
	'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><?=Html::encode($this->title);?></h3></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <input id="inp-route" type="text" class="form-control"
                           placeholder="<?=Yii::t('authmanager','New route(s)');?>">
                    <span class="input-group-btn">
                <?=Html::a(Yii::t('authmanager','Add') . $animateIcon,['create'],[
	                'class' => 'btn btn-success',
	                'id'    => 'btn-new',
                ]);?>
            </span>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="form-control search" data-target="available"
                           placeholder="<?=Yii::t('authmanager','Search for available');?>">
                    <span class="input-group-btn">
                <?=Html::a('<span class="glyphicon glyphicon-refresh"></span>',['refresh'],[
	                'class' => 'btn btn-default',
	                'id'    => 'btn-refresh',
                ]);?>
            </span>
                </div>
                <select multiple size="20" class="form-control list" data-target="available"></select>
            </div>
            <div class="col-sm-2 text-center">
                <br><br>
				<?=Html::a('<i class="fa fa-angle-double-right"></i>' . $animateIcon,['assign'],[
					'class'       => 'btn btn-success btn-assign',
					'data-target' => 'available',
					'title'       => Yii::t('authmanager','Assign'),
				]);?><br><br>
				<?=Html::a('<i class="fa fa-angle-double-left"></i>' . $animateIcon,['remove'],[
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
