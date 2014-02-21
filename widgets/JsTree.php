<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-jstree
 * @version 1.0.0
 */

namespace talma\widgets;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * JsTree widget is a Yii2 wrapper for the jsTree jQuery plugin.
 *
 * @author Thiago Talma <thiago@thiagomt.com>
 * @since 1.0
 * @see http://jstree.com
 */
class JsTree extends \yii\widgets\InputWidget
{
	public $defaults = [];
	public $plugins = [];
	public $types = [];
	public $path = [];
	public $treeData = [];

	public function init()
	{
		parent::init();
		$this->registerAssets();

		$this->options['id'] = 'jsTree_' . $this->options['id'];
		echo Html::tag('div', '', $this->options);
	}

	/**
	 * Registers the needed assets
	 */
	public function registerAssets()
	{
		$view = $this->getView();
		JsTreeAsset::register($view);

		$default = array_merge($this->defaults, [
			'plugins' => $this->plugins,
			'types' => $this->types,
		]);

		$json = Json::encode($default);

		$js = "\$('#jsTree_{$this->options['id']}').jstree({$json});";
		$view->registerJs($js);
	}

}