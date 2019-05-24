<?php

use vthang87\authmanager\AnimateAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model vthang87\authmanager\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if(!empty($fullnameField)){
	$userName .= ' (' . ArrayHelper::getValue($model,$fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('authmanager','Assignment') . ' : ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('authmanager','Assignments'),'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
	'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="assignment-index">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><?=$this->title;?></h3></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="available"
                           placeholder="<?=Yii::t('authmanager','Search for available');?>">
                    <select multiple size="20" class="form-control list" data-target="available">
                    </select>
                </div>
                <div class="col-sm-2 text-center">
                    <br><br>
					<?=Html::a('<i class="fa fa-angle-double-right"></i>' . $animateIcon,['assign','id' => (string)$model->id],[
						'class'       => 'btn btn-success btn-assign',
						'data-target' => 'available',
						'title'       => Yii::t('authmanager','Assign'),
					]);?><br><br>
					<?=Html::a('<i class="fa fa-angle-double-left"></i>' . $animateIcon,['revoke','id' => (string)$model->id],[
						'class'       => 'btn btn-danger btn-assign',
						'data-target' => 'assigned',
						'title'       => Yii::t('authmanager','Remove'),
					]);?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?=Yii::t('authmanager','Search for assigned');?>">
                    <select multiple size="20" class="form-control list" data-target="assigned">
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
