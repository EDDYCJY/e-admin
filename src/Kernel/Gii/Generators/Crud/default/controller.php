<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
use Eadmin\Config;
use Eadmin\Constants;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Expand\Start;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$searchClass = isset($searchModelAlias) ? $searchModelAlias : $searchModelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

$fullName = Config::get('Database', 'table_prefix') . Helpers::getUnderscore(Helpers::getLastIndex($class));

$excelWidgetParams = $generator->generateExcelWidgetParams($fullName);
$excelModelParams = $generator->generateExcelModelParams($fullName);
$container = Container::make($fullName);
$imageFields = Start::field($fullName, Constants::IMAGE_FIELD);
$splitFields = Start::field($fullName, Constants::SPLIT_FIELD);

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use moonland\phpexcel\Excel;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    public $layout = 'admin';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new <?= $searchClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $exportParams = isset(Yii::$app->request->queryParams['<?= $searchClass ?>']) ? Yii::$app->request->queryParams['<?= $searchClass ?>'] : [];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'exportUrl'    => Url::toRoute(['export', '<?= $searchClass ?>' => $exportParams]),
        ]);
    }

    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionView(<?= $actionParams ?>)
    {
        return $this->render('view', [
            'model' => $this->findModel(<?= $actionParams ?>),
        ]);
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();
        if($model->load(Yii::$app->request->post())) {
<?php if(! empty($imageFields)): ?>
            $model->setScenario('create');
<?php endif; ?>
<?php if(! empty($splitFields)): 
      foreach($splitFields as $index => $field): ?>
            $model-><?= $field?> = (! empty($model-><?= $field ?>)) ? implode(',', $model-><?= $field ?>) : '';
<?php endforeach; 
      endif; ?>
<?php if(! empty($imageFields)): ?>
            $upload  = new \backend\models\UploadForm();
            $uploads = new \backend\models\UploadsForm();
<?php foreach($imageFields as $field => $type): 
      if($type == 1): ?>
            $upload->file = \yii\web\UploadedFile::getInstance($model, '<?= $field ?>');
            $uploadResult = $upload->upload();
            if($uploadResult !== false) {
                $model-><?= $field ?> = $uploadResult;
            }

<?php endif;  
      if($type == 2): ?>
            $uploads->files = \yii\web\UploadedFile::getInstances($model, '<?= $field ?>');
            $uploadResult = $uploads->upload();
            if($uploadResult !== false) {
                $model-><?= $field ?> = implode(',', $uploadResult);
            }

<?php endif; 
      endforeach; 
      endif; ?>
            if($model->save()) {
                return $this->redirect(['index']);
            } else {
<?php foreach($imageFields as $field => $type): ?>
                $model-><?= $field ?> = null;
<?php endforeach; ?>
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);
        if($model->load(Yii::$app->request->post())) {
<?php if(! empty($splitFields)): 
      foreach($splitFields as $index => $field): ?>
            $model-><?= $field?> = (! empty($model-><?= $field ?>)) ? implode(',', $model-><?= $field ?>) : '';
<?php endforeach; 
      endif; 
      if(! empty($imageFields)): ?>
            $upload  = new \backend\models\UploadForm();
            $uploads = new \backend\models\UploadsForm();
<?php foreach($imageFields as $field => $type):
      if($type == 1): ?>
            $upload->file = \yii\web\UploadedFile::getInstance($model, '<?= $field ?>');
            $uploadResult = $upload->upload();
            if($uploadResult !== false) {
                 $model-><?= $field ?> = $uploadResult;
            } else {
                unset($model-><?= $field ?>);
            }
            
<?php endif; ?>

<?php if($type == 2): ?>
            $uploads->files = \yii\web\UploadedFile::getInstances($model, '<?= $field ?>');
            $uploadResult = $uploads->upload();
            if($uploadResult !== false) {
                $model-><?= $field ?> = implode(',', $uploadResult);
            } else {
                unset($model-><?= $field ?>);
            }

<?php endif; 
      endforeach; 
      endif; ?>
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
<?php if(! empty($splitFields)): 
      foreach($splitFields as $index => $field): ?>
            $model-><?= $field?> = explode(',', $model-><?= $field ?>);
<?php endforeach; 
      endif; ?>
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        $this->findModel(<?= $actionParams ?>)->delete();

        return $this->redirect(['index']);
    }

    /**
     * DeleteAll an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionDeleteAll($ids)
    {
        if(! empty($ids)) {
            $model = new <?= $modelClass ?>();
            $model->deleteAll(['id' => explode(',', $ids)]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Output <?= $modelClass ?> export.
     * @return mixed
     */
    public function actionExport()
    {
        $searchModel = new <?= $searchClass ?>();
        $dataProvider = $searchModel->export(Yii::$app->request->queryParams);
        $modelProvider = $dataProvider->getModels();
<?php if(! empty($excelModelParams)): ?>
        foreach ($modelProvider as $index => $model) {
<?php foreach($excelModelParams as $field => $value): ?>
            $modelProvider[$index]-><?= $field ?> = <?php if($value['type'] == 2): ?>$model<?php endif; ?><?= $value['value'] ?>;
<?php endforeach; ?>
        }
<?php endif; ?>

        Excel::widget(<?= $excelWidgetParams ?>);
    }

    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
    }
}
