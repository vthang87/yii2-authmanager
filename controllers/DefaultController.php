<?php

namespace vthang87\authmanager\controllers;

use Yii;

/**
 * DefaultController
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class DefaultController extends \yii\web\Controller
{

    /**
     * Action index
     */
    public function actionIndex($page = 'README.md')
    {
        if (strpos($page, '.png') !== false) {
            $file = Yii::getAlias("@vthang87/authmanager/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
        return $this->render('index', ['page' => $page]);
    }
}
