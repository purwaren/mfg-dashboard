<?php

class ItemHistoryGudangController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','reload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($kode)
	{
		$model=ItemHistoryGudang::model()->findByAttributes(array('item_code'=>$kode));
		$dist=ItemDistribution::model()->findAllByAttributes(array(
			'item_code'=>$kode
		));
		$this->render('view',array(
			'model'=>$model,
			'dist'=>$dist,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ItemHistoryGudang;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemHistoryGudang']))
		{
			$model->attributes=$_POST['ItemHistoryGudang'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemHistoryGudang']))
		{
			$model->attributes=$_POST['ItemHistoryGudang'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ItemHistoryGudang');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($page=1)
	{
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		
		$model=new ItemHistoryGudang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['ItemHistoryGudang']))
		{
			Yii::app()->user->setState('ItemHistoryGudang',$_POST['ItemHistoryGudang']);
		}		
		
		$itemHist=Yii::app()->user->getState('ItemHistoryGudang');
		$data='';$pages='';$summary='';
		if(isset($itemHist))
		{
			$model->attributes=$itemHist;			
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
			
			//get all item
			$data=$model->searchHistory();
			
			//set pagination
			$count = $model->countItemHistory();
				
			$pages = new CPagination($count);
			$pages->pageSize = $model->size;
			if($count==0)
				$summary='0';
			else if($count-$start < 10)
				$summary=$start.'-'.$count.' dari '.$count;
			else $summary=$start.'-'.$end.' dari '.$count;			
		}

		$this->render('admin',array(
			'model'=>$model,
			'data'=>$data,			
			'pages'=>$pages,
			'page'=>$page,
			'summary'=>$summary,			
			'itemHist'=>$itemHist
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ItemHistoryGudang::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-history-gudang-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
