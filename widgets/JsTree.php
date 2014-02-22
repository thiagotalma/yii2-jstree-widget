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

		echo Html::activeTextInput($this->model, $this->attribute, ['class' => 'hidden', 'value' => $this->value]);

		$this->options['id'] = 'jsTree_' . $this->options['id'];
		Html::addCssClass($this->options, "js_tree_{$this->attribute}");
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

		$inputId = Html::getInputId($this->model, $this->attribute);

		$js = <<<SCRIPT
;(function($, window, document, undefined) {
	$('#jsTree_{$this->options['id']}')
		.bind("loaded.jstree", function (event, data) {
				$("#{$inputId}").val(JSON.stringify(data.selected));
			})
		.bind("changed.jstree", function(e, data, x){
				$("#{$inputId}").val(JSON.stringify(data.selected));
		})
		.jstree({$json});
})(window.jQuery, window, document);
SCRIPT;
		$view->registerJs($js);
	}

}