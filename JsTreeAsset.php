<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-jstree
 * @version 1.0.0
 */

namespace talma\widgets;

use yii\web\AssetBundle;

/**
 * Asset bundle for JsTree Widget
 *
 * @author Thiago Talma <thiago@thiagomt.com>
 * @since 1.0
 */
class JsTreeAsset extends AssetBundle
{
	/**
	 * Set up CSS and JS asset arrays based on the base-file names
	 * @param string $type whether 'css' or 'js'
	 * @param array $files the list of 'css' or 'js' basefile names
	 */
	protected function setupAssets($type, $files = [])
	{
		$srcFiles = [];
		$minFiles = [];
		foreach ($files as $file) {
			$srcFiles[] = "{$file}.{$type}";
			$minFiles[] = "{$file}.min.{$type}";
		}
		if (empty($this->$type)) {
			$this->$type = YII_DEBUG ? $srcFiles : $minFiles;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->setSourcePath(__DIR__ . '/assets');
		$this->setupAssets('css', ['themes/default/style']);
		$this->setupAssets('js', ['jstree']);
		parent::init();
	}

}