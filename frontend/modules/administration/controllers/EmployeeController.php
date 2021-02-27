<?php

namespace frontend\modules\administration\controllers;

use Yii;
use frontend\modules\models\Employee;
use frontend\modules\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\modules\models\Refregion;
use frontend\modules\models\Refprovince;
use frontend\modules\models\Refcitymun;
use frontend\modules\models\Refbrgy;
use frontend\modules\models\Status;
use frontend\modules\models\EmployeeAddress;
use frontend\modules\models\EmployeeAffiliation;
use frontend\modules\models\EmploymentDesignation;
use frontend\modules\models\EmploymentStatus;
//use frontend\modules\models\EmployeeDailyTimeRecordSearch;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionMasterList()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $addressId = EmployeeAddress::find()->where(['employee_id' => $id])->one();
        $affiliationId = EmployeeAffiliation::find()->where(['employee_id' => $id])->one();
        $region = Refregion::find()->where(['id'=>$addressId->region_id])->one();
        $province = Refprovince::find()->where(['id'=>$addressId->province_id])->one();
        $municipality = Refcitymun::find()->where(['id'=>$addressId->municipality_id])->one();
        $barangay = Refbrgy::find()->where(['id'=>$addressId->barangay_id])->one();
        $designation = EmploymentDesignation::find()->where(['id'=>$affiliationId->employment_designation_id])->one();
        $employmentStatus = EmploymentStatus::find()->where(['id'=>$affiliationId->employment_status_id])->one();
        
        $address = $addressId->prefix_address.', '.$barangay->brgyDesc.', '.$municipality->citymunDesc.', '.$province->provDesc.', '.$region->regDesc;
        
        $affiliation['designation'] = $designation->employment_designation_code_description;
        $affiliation['status'] = $employmentStatus->employment_status_description;
        
        return $this->render('crud/view', [
            'model' => $this->findModel($id),
            'address' => $address,
            'affiliation' => $affiliation,
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $address = new EmployeeAddress();
        $affiliation = new EmployeeAffiliation();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/
        if ($model->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()) && $affiliation->load(Yii::$app->request->post())) {
            $model->save(false);
            $id = $model->getPrimaryKey();
            $address->employee_id = $id;
            $affiliation->employee_id = $id;
            $address->save();
            $affiliation->save();
            return $this->redirect(['view',
                'id' => $model->id
            ]);
        }
        
        $status = ArrayHelper::map(Status::find()->all(), 'id', 'status_code');
        $region = ArrayHelper::map(Refregion::find()->all(), 'id', 'regDesc');
        $employment_designation = ArrayHelper::map(EmploymentDesignation::find()->all(), 'id', 'employment_designation_code_description');
        $employment_status = ArrayHelper::map(EmploymentStatus::find()->all(), 'id', 'employment_status_description');

        return $this->render('crud/create', [
            'model' => $model,
            'address' => $address,
            'affiliation' => $affiliation,
            'status' => $status,
            'region' => $region,
            'employment_designation' => $employment_designation,
            'employment_status' => $employment_status,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $address = EmployeeAddress::find()->where(['employee_id' => $id])->one();
        $affiliation = EmployeeAffiliation::find()->where(['employee_id' => $id])->one();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/
        if ($model->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()) && $affiliation->load(Yii::$app->request->post())) {
            $model->save();
            $address->save();
            $affiliation->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        $status = ArrayHelper::map(Status::find()->all(), 'id', 'status_code');
        $region = ArrayHelper::map(Refregion::find()->all(), 'id', 'regDesc');
        $province = ArrayHelper::map(Refprovince::find()->all(), 'id', 'provDesc');
        $municipality = ArrayHelper::map(Refcitymun::find()->all(), 'id', 'citymunDesc');
        $barangay = ArrayHelper::map(Refbrgy::find()->all(), 'id', 'brgyDesc');
        $employment_designation = ArrayHelper::map(EmploymentDesignation::find()->all(), 'id', 'employment_designation_code_description');
        $employment_status = ArrayHelper::map(EmploymentStatus::find()->all(), 'id', 'employment_status_description');

        return $this->render('crud/update', [
            'model' => $model,
            'address' => $address,
            'affiliation' => $affiliation,
            'status' => $status,
            'region' => $region,
            'province' => $province,
            'municipality' => $municipality,
            'barangay' => $barangay,
            'employment_designation' => $employment_designation,
            'employment_status' => $employment_status,
        ]);
    }

    /**
     * Deletes an existing Employee model.
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
    
    public function actionAttendance()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('attendance', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionPayroll()
    {
        return $this->render('payroll', [
            'model' => 'Payroll',
        ]);
    }
    
    public function actionStatus()
    {
        return $this->render('status', [
            'model' => 'Status',
        ]);
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
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
