<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use common\eadmin\kernel\support\Helpers;
use common\eadmin\kernel\support\Container;
use common\eadmin\Config;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$config = new Config();

$class = Helpers::getLastIndex($generator->modelClass);
$fullName  = $config->table_prefix . '_' . Helpers::getUnderscore($class);
$container = Container::make($fullName);

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

	<div class="box-body">
    <?= "<?php " ?>$form = ActiveForm::begin([
            'options' => [
                'class' => 'form-horizontal',
            ],
            'fieldConfig' => [
                'template' => '<div class="form-group">{label}<div class="col-sm-8">{input}{error}</div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        if(! empty($container['showParams']['detail_display'])) {
            if(in_array($attribute, $container['showParams']['detail_display'])) {
                echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
            }
        } else {
            echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
        }
    }
} ?>

    <div class="box-footer">
    	<?= "<?= Html::a('返回', ['index'], ['class' => 'btn btn-default']) ?>\n\n" ?>
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('创建') ?> : <?= $generator->generateString('更新') ?>, ['class' => $model->isNewRecord ? 'btn btn-success  pull-right' : 'btn btn-primary  pull-right']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>
	</div>

</div>
