<?php

namespace vthang87\authmanager;

use yii\web\AssetBundle;

/**
 * Description of AnimateAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since  2.5
 */
class FontAwesomeAsset extends AssetBundle{
	/**
	 * @inheritdoc
	 */
	public $depends = [
		'rmrevin\yii\fontawesome\AssetBundle',
	];
	
}
