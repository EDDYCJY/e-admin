<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
use Eadmin\Config;
use Eadmin\Constants;
use Eadmin\Kernel\Support\Helpers;

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
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

$fullName = Config::get('Database', 'table_prefix') . Helpers::getUnderscore(Helpers::getLastIndex($class));
$imageFields = Helpers::getImageFields($fullName);

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
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
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
<?php if(! empty($imageFields)): ?>
        $model->setScenario('create');
        if($model->load(Yii::$app->request->post())) {
        
            $upload  = new \backend\models\UploadForm();
            $uploads = new \backend\models\UploadsForm();
<?php foreach($imageFields as $field => $type): ?>
<?php if($type == 1): ?>
            $upload->file = \yii\web\UploadedFile::getInstance($model, '<?php echo $field ?>');
            $uploadResult = $upload->upload();
            if($uploadResult !== false) {
                $model-><?php echo $field ?> = $uploadResult;
            }
<?php endif; ?>

<?php if($type == 2): ?>
            $uploads->files = \yii\web\UploadedFile::getInstances($model, '<?php echo $field ?>');
            $uploadResult = $uploads->upload();
            if($uploadResult !== false) {
                $model-><?php echo $field ?> = implode(',', $uploadResult);
            }

<?php endif; ?>
<?php endforeach; ?>
            if($model->save(false)) {
                return $this->redirect(['index']);
            }
        }
<?php else: ?>

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
<?php endif; ?>

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
<?php if(! empty($imageFields)): ?>
        if($model->load(Yii::$app->request->post())) {

            $upload  = new \backend\models\UploadForm();
            $uploads = new \backend\models\UploadsForm();
<?php foreach($imageFields as $field => $type):?>
<?php if($type == 1): ?>
            $upload->file = \yii\web\UploadedFile::getInstance($model, '<?php echo $field ?>');
            $uploadResult = $upload->upload();
            if($uploadResult !== false) {
                 $model-><?php echo $field ?> = $uploadResult;
            } else {
                unset($model-><?php echo $field ?>);
            }
<?php endif; ?>

<?php if($type == 2): ?>
            $uploads->files = \yii\web\UploadedFile::getInstances($model, '<?php echo $field ?>');
            $uploadResult = $uploads->upload();
            if($uploadResult !== false) {
                $model-><?php echo $field ?> = implode(',', $uploadResult);
            } else {
                unset($model-><?php echo $field ?>);
            }

<?php endif; ?>
<?php endforeach; ?>
            if($model->save(false)) {
                return $this->redirect(['index']);
            }
        }

<?php else: ?>

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

<?php endif; ?>

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
