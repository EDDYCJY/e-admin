<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminUser;
use backend\models\AdminUserSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use moonland\phpexcel\Excel;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends AdminController
{
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
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $exportParams = isset(Yii::$app->request->queryParams['AdminUserSearch']) ? Yii::$app->request->queryParams['AdminUserSearch'] : [];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'exportUrl'    => Url::toRoute(['export', 'AdminUserSearch' => $exportParams]),
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();
        if($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                return $this->redirect(['index']);
            } else {
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(! empty($model) && ($this->adminRoleId === $this->superRoleId || $model->id === $this->adminId)) {
            if($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        throw new UnauthorizedHttpException("Permission denied");
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(! empty($model) && ($this->adminRoleId === $this->superRoleId || $model->id === $this->adminId)) {
            $model->delete();

            return $this->redirect(['index']);
        }
        
        throw new UnauthorizedHttpException("Permission denied");
    }

    /**
     * Output AdminUser export.
     * @return mixed
     */
    public function actionExport()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->export(Yii::$app->request->queryParams);
        $modelProvider = $dataProvider->getModels();
        foreach ($modelProvider as $index => $model) {
            if(isset($model->getRelatedRecords()['adminRole'])) {
                $modelProvider[$index]->role_id = $model->getRelatedRecords()['adminRole']->getAttributes()['role_name'];
            }
            $modelProvider[$index]->created_on = date('Y-m-d H:i', $modelProvider[$index]->created_on);
            $modelProvider[$index]->modify_on = date('Y-m-d H:i', $modelProvider[$index]->modify_on);
        }

        Excel::widget([
            'models' => $dataProvider->getModels(),
            'mode' => 'export',
            'fileName' => '后台管理员-' . date("Y-m-d", time()),
            'format' => 'Excel5',
            'columns' => [
                '0' => 'id',
                '1' => 'role_id',
                '2' => 'user_name',
                '4' => 'created_on',
                '5' => 'created_by',
                '6' => 'modify_on',
                '7' => 'modify_by',
                '8' => 'state',
            ],
            'headers' => [
                'role_id' => '权限名称',
            ],
        ]);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
