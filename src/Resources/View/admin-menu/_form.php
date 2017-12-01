<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Eadmin\Kernel\Support\Helpers;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-menu-form">
	<div class="box-body">
    <?php $form = ActiveForm::begin([
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

    <?= $form->field($model, 'parent_id')->widget('kartik\select2\Select2', [
            'data' => array_merge([0 => '顶级菜单'], Helpers::getSelectMap(\backend\models\AdminMenu::find()->all(), 'id', 'menu_name')),
            'options' => [
                'placeholder' => 'Select a state ...',
            ],
            'pluginOptions' => [
                'allowClear' => '1',
            ],
        ]) ?>

    <?= $form->field($model, 'menu_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->widget('Iconpicker\Widgets\Iconpicker', [
            'options' => [
            ],
        ]) ?>

    <?= $form->field($model, 'is_show')->radioList([
            '0' => '否',
            '1' => '是',
        ], [
            'class' => 'radio',
        ]) ?>

    <?= $form->field($model, 'state')->radioList([
            '0' => '禁用',
            '1' => '启用',
        ], [
            'class' => 'radio',
        ]) ?>


    <div class="box-footer">
    	<?= Html::a('返回', ['index'], ['class' => 'btn btn-default']) ?>

        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success  pull-right' : 'btn btn-primary  pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	</div>
</div>
