<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use Eadmin\Kernel\Support\Container;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$tableSchema = $generator->getTableSchema();
$container = Container::make($tableSchema->fullName);
$title = ! empty($container['metaParams']['label']) ? $container['metaParams']['label'] : $container['metaParams']['verbose_name'];

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($title))) ?>;
?>


<div class="row">
  <div class="col-md-10">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">创建</h3>
      </div>
	    <?= "<?= " ?>$this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </div>
  </div>
</div>