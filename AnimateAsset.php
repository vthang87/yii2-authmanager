<?php

namespace vthang87\authmanager;

use yii\web\AssetBundle;

/**
 * Description of AnimateAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 2.5
 */
class AnimateAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vthang87/authmanager/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'animate.css',
    ];
	
	/**
	 * @inheritdoc
	 */
	public $depends = [
		'yii\web\JqueryAsset',
	];
}
