<?php

namespace Eadmin\Expand\View;

use Eadmin\Kernel\Support\VarDumper;

class RelationField
{
	public static function column($attribute, $container)
	{
		$result = null;
		$containerAttr = $container['modelParams'][$attribute];

		if(! empty($containerAttr['relations'])) {
			$values = [
				'attribute' => $attribute,
				'label' => $containerAttr['relations']['label'],
				'value' => lcfirst($containerAttr['relations']['class']) . '.' . $containerAttr['relations']['attribute'],
				'filter' => [
					'separator' => '',
					'value' => "Html::activeTextInput(\$searchModel, '{$containerAttr['relations']['attribute']}', [ 'class' => 'form-control' ])",
				],
			];

			$result = VarDumper::exportSeparator($values);
		}

		return $result;
	}
}