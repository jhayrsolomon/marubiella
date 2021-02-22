<?php

namespace frontend\modules\customers\controllers;

use Yii;
use frontend\modules\models\Customer;
use frontend\modules\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\modules\models\Refregion;
use frontend\modules\models\Refprovince;
use frontend\modules\models\Refcitymun;
use frontend\modules\models\Refbrgy;
use frontend\modules\models\CustomerType;
use frontend\modules\models\CustomerStatus;

/**
 * MasterListController implements the CRUD actions for Customer model.
 */
class MasterListController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $region = Refregion::find()->where(['id'=>$model->region_id])->one();
        $province = Refprovince::find()->where(['id'=>$model->province_id])->one();
        $municipality = Refcitymun::find()->where(['id'=>$model->municipality_id])->one();
        $barangay = Refbrgy::find()->where(['id'=>$model->barangay_id])->one();
        
        $address = $model->prefix_address.', '.$barangay->brgyDesc.', '.$municipality->citymunDesc.', '.$province->provDesc.', '.$region->regDesc;
        $type = CustomerType::find()->where(['id'=>$model->customer_type_id])->one();
        $status = CustomerStatus::find()->where(['id'=>$model->customer_status_id])->one();
        
        return $this->render('crud/view', [
            //'model' => $this->findModel($id),
            'model' => $model,
            'address' => $address,
            'type' => $type,
            'status' => $status,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        $region = ArrayHelper::map(Refregion::find()->all(), 'id', 'regDesc');
        $customer_type = ArrayHelper::map(CustomerType::find()->all(), 'id', 'customer_type_name');
        $customer_status = ArrayHelper::map(CustomerStatus::find()->all(), 'id', 'customer_status_name');

        return $this->render('crud/create', [
            'model' => $model,
            'region' => $region,
            'customer_type' => $customer_type,
            'customer_status' => $customer_status,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        $region = ArrayHelper::map(Refregion::find()->all(), 'id', 'regDesc');
        $province = ArrayHelper::map(Refprovince::find()->all(), 'id', 'provDesc');
        $municipality = ArrayHelper::map(Refcitymun::find()->all(), 'id', 'citymunDesc');
        $barangay = ArrayHelper::map(Refbrgy::find()->all(), 'id', 'brgyDesc');
        $customer_type = ArrayHelper::map(CustomerType::find()->all(), 'id', 'customer_type_name');
        $customer_status = ArrayHelper::map(CustomerStatus::find()->all(), 'id', 'customer_status_name');
        

        return $this->render('crud/update', [
            'model' => $model,
            'region' => $region,
            'province' => $province,
            'municipality' => $municipality,
            'barangay' => $barangay,
            'customer_type' => $customer_type,
            'customer_status' => $customer_status,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionLoadprovince()
    {
        if(isset($_POST['region_id'])){
            $region = Refregion::find()->where(['id' => $_POST['region_id']])->one();
            $data = Refprovince::find()->where(['regCode' => $region->regCode])->all();
            \Yii::$app->response->format = 'json';
            return $data;
        }
    }
    
    public function actionLoadmunicipality()
    {
        if(isset($_POST['province_id'])){
            $province = Refprovince::find()->where(['id' => $_POST['province_id']])->one();
            $data = Refcitymun::find()->where(['regDesc' => $province->regCode, 'provCode' => $province->provCode])->all();
            \Yii::$app->response->format = 'json';
            return $data;
        }
    }
    
    public function actionLoadbarangay()
    {
        if(isset($_POST['municipality_id'])){
            $municipality = Refcitymun::find()->where(['id' => $_POST['municipality_id']])->one();
            $data = Refbrgy::find()->where(['regCode' => $municipality->regDesc, 'provCode' => $municipality->provCode, 'citymunCode' => $municipality->citymunCode])->all();
            \Yii::$app->response->format = 'json';
            return $data;
        }
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
