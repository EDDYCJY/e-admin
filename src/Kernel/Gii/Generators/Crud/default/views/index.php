<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Expand\Start;
use Eadmin\Config;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$tableSchema = $generator->getTableSchema();
$container = Container::make($tableSchema->fullName);
$hiddenListDisplay = Config::get('App', 'eadmin_hidden_list_display');

$title = ! empty($container['metaParams']['label_name']) ? $container['metaParams']['label_name'] : $container['metaParams']['verbose_name'];

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString($title) ?>;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <div class="col-sm-12" style="text-align: right;">
                  <?= "<?= " ?>Html::a(<?= $generator->generateString('创建') ?>, ['create'], ['class' => 'btn btn-success']) ?>
                  <?= "<?= " ?>Html::a(<?= $generator->generateString('导出') ?>, $exportUrl, ['class' => 'btn btn-primary']) ?>
                  <?= "<?= " ?>Html::a(<?= $generator->generateString('重置') ?>, ['index'], ['class' => 'btn btn-default']) ?>
              </div>
            </div>
            <div class="box-body">

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;

if ($tableSchema === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            " . Start::view($name) . ",\n";
        } else {
            echo "            //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if(! empty($container['showParams']['list_display'])) {
                if(in_array($column->name, $container['showParams']['list_display'])) {
                    echo "            " . Start::view($column->name, $container) . ",\n";
                } else {
                    echo "            //'" . $column->name . "',\n";
                }
        } else {
            if(! in_array($column->name, $hiddenListDisplay)) {
                if (++$count < 6) {
                    echo "            " . Start::view($column->name, $container) . ",\n";
                } else {
                    echo "            //'" . $column->name . "',\n";
                }
            }   
        }
    }
}
?>

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
      </div>
    </div>
  </div>
</div>
