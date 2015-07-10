<?php

class SoldItemController extends Controller
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
				'actions'=>array('create','update','admin','delete','reload','rekap'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SoldItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SoldItem']))
		{
			$model->attributes=$_POST['SoldItem'];
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

		if(isset($_POST['SoldItem']))
		{
			$model->attributes=$_POST['SoldItem'];
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
		$dataProvider=new CActiveDataProvider('SoldItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionRekap($page=1,$print="no")
	{
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		$model=new SoldItem('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_POST['SoldItem']))
		{			
			Yii::app()->user->setState('SoldItem',$_POST['SoldItem']);
		}
		$soldItem = Yii::app()->user->getState('SoldItem');
		$data='';$store='';$pages='';$summary='';$total='';$group='';
		
		if(isset($soldItem))
		{
			$model->attributes=$soldItem;
				
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
			if($print=='yes') {
				$model->start=null;$model->size=null;
			}
			//data
			$data = $model->findAllQtyRekap();
			
			//pagination
			//set pagination
			$count = $model->countAllUniqueItemCategory();
				
			$pages = new CPagination($count);
			$pages->pageSize = $model->size;
			if($count==0)
				$summary='0';
			else if($count-$start < 10)
				$summary=$start.'-'.$count.' dari '.$count;
			else $summary=$start.'-'.$end.' dari '.$count;
		}
		if($print=='yes')
		{
			$this->layout='//layouts/print';
			
			$this->render('print-rekap',array(
					'model'=>$model,
					'data'=>$data,
					'store'=>$store,
					'pages'=>$pages,
					'page'=>$page,
					'summary'=>$summary,
					'soldItem'=>$soldItem,
					'group'=>$group
			));
		}
		else
			$this->render('rekap',array(
				'model'=>$model,
				'data'=>$data,
				'store'=>$store,
				'pages'=>$pages,
				'page'=>$page,
				'summary'=>$summary,
				'soldItem'=>$soldItem,
				'group'=>$group
			));
			
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($page=1)
	{
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		$model=new SoldItem('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_POST['SoldItem']))
		{			
			Yii::app()->user->setState('SoldItem',$_POST['SoldItem']);
		}
		$soldItem = Yii::app()->user->getState('SoldItem');
		$data='';$store='';$pages='';$summary='';$total='';$group='';
		if(isset($soldItem))
		{
			//var_dump($soldItem);
			$model->attributes=$soldItem;
			
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
			
			//get all store
			$group=Store::model()->getAllStoreByGroup();
			$store=Store::model()->findAllBySql('SELECT * FROM store ORDER BY koalisi, urutan');
			
			//get all unique category
			$data = $model->findAllUniqueItemCategory();
			
			//set pagination
			$count = $model->countAllUniqueItemCategory();
			
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
			'store'=>$store,
			'pages'=>$pages,
			'page'=>$page,
			'summary'=>$summary,
			'soldItem'=>$soldItem,
			'group'=>$group
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SoldItem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SoldItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SoldItem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sold-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
