<?php

namespace Eadmin\Expand\View;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class RelationField
 * @package Eadmin\Expand\View
 */
class RelationField
{
    /**
     * Get GridView Column
     *
     * @param  string $attribute field attribute
     * @param  array  $container model container
     * @return string
     */
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

			$result = VarDumper::exportSeparator($values, ['headSpace' => 16, 'footSpace' => 12]);
		}

		return $result;
	}
}