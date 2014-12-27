<?php

class ItemHistoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('create','update','admin','adminJakarta','viewJakarta','adminJakartaSales'),
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
		$model = ItemHistory::model()->findByAttributes(array(
			'item_code'=>$id
		));
		if($model===null)
			throw new CHttpException(404,'Halaman yang ada minta tidak tersedia');
		$models = ItemHistory::model()->hist()->findAllByAttributes(array(
			'item_code'=>$id
		));
		$this->render('view',array(
			'model'=>$model,
			'models'=>$models
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewJakarta($id)
	{
		$this->layout='//layouts/column1';
		$model = ItemHistoryGudang::model()->findByAttributes(array(
				'item_code'=>$id
		));
		
		if($model===null)
			throw new CHttpException(404,'Halaman yang ada minta tidak tersedia');
		
		$supplier = Supplier::model()->findByAttributes(array('sup_code'=>$model->supplier));
		$models = ItemHistory::model()->hist()->findAllByAttributes(array(
				'item_code'=>$id
		));
		$this->render('viewJakarta',array(
			'model'=>$model,
			'models'=>$models,
			'supplier'=>$supplier
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ItemHistory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemHistory']))
		{
			$model->attributes=$_POST['ItemHistory'];
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

		if(isset($_POST['ItemHistory']))
		{
			$model->attributes=$_POST['ItemHistory'];
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
		$dataProvider=new CActiveDataProvider('ItemHistory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminJakarta($page=1)
	{
		$this->layout='//layouts/column1';
		
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		$model=new ItemHistoryJakarta('search');
		$model->unsetAttributes();  // clear any default values		
		
		if(isset($_POST['ItemHistoryJakarta']))
		{			
			Yii::app()->user->setState('ItemHistoryJakarta',$_POST['ItemHistoryJakarta']);
		}
			
		$itemHist=Yii::app()->user->getState('ItemHistoryJakarta');
		$data='';$store='';$pages='';$summary='';$total='';
		if(isset($itemHist))
		{	
			$model->attributes=$itemHist;	
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
			
			//get all store
			$store=Store::model()->findAllBySql('SELECT * FROM store ORDER BY code');
			
			//get all item
			$data=$model->searchUniqueItem();
			
			//set pagination
			$count = $model->countUniqueItem();
			
			$pages = new CPagination($count);
			$pages->pageSize = $model->size;
			if($count==0)
				$summary='0';
			else if($count-$start < 10)
				$summary=$start.'-'.$count.' dari '.$count;		 
			else $summary=$start.'-'.$end.' dari '.$count;
			
		}
		//var_dump($data);exit;
		$this->render('adminJakarta',array(
			'model'=>$model,
			'data'=>$data,
			'store'=>$store,
			'pages'=>$pages,
			'page'=>$page,
			'summary'=>$summary,			
			'itemHist'=>$itemHist
		));
	}
	
	public function actionAdmin($page=1)
	{
		$this->layout='//layouts/column1';
	
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		$model=new ItemHistory('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_POST['ItemHistory']))
		{
			Yii::app()->user->setState('ItemHistory',$_POST['ItemHistory']);
		}
			
		$itemHist=Yii::app()->user->getState('ItemHistory');
		$data='';$store='';$pages='';$summary='';$total='';$group='';
		if(isset($itemHist))
		{
			$model->attributes=$itemHist;
			
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
				
			//get all store
			$group=Store::model()->getAllStoreByGroup();
			$store=Store::model()->findAllBySql('SELECT * FROM store ORDER BY koalisi, urutan');
			//get all item
			$data=$model->searchUniqueItem();
				
			//set pagination
			$count = $model->countUniqueItem();
				
			$pages = new CPagination($count);
			$pages->pageSize = $model->size;
			if($count==0)
				$summary='0';
			else if($count-$start < 10)
				$summary=$start.'-'.$count.' dari '.$count;
			else $summary=$start.'-'.$end.' dari '.$count;
			
			$total=$model->summaryAllItem();
		}
		//var_dump($pages);exit;
		$this->render('admin',array(
			'model'=>$model,
			'data'=>$data,
			'store'=>$store,
			'pages'=>$pages,
			'page'=>$page,
			'summary'=>$summary,
			'total'=>$total,
			'itemHist'=>$itemHist,
			'group'=>$group
		));
	}
	
	public function actionAdminJakartaSales($page=1)
	{
		$this->layout='//layouts/column1';
	
		Yii::app()->user->setReturnUrl(Yii::app()->request->requestUri);
		$model=new ItemJakartaSales('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_POST['ItemJakartaSales']))
		{
			Yii::app()->user->setState('ItemJakartaSales',$_POST['ItemJakartaSales']);
		}
			
		$itemHist=Yii::app()->user->getState('ItemJakartaSales');
		$data='';$store='';$pages='';$summary='';$total='';
		if(isset($itemHist))
		{
			$model->attributes=$itemHist;
			//setting page size
			$model->size = Yii::app()->params['pagination']['size'];
			$model->start = $model->size*($page-1);
			$start = $model->size*($page-1)+1;
			$end=$model->size*$page;
	
			
	
			//get all item
			$data=$model->searchUniqueItem();
	
			//set pagination
			$count = $model->countUniqueItem();
	
			$pages = new CPagination($count);
			$pages->pageSize = $model->size;
			if($count==0)
				$summary='0';
			else if($count-$start < 10)
				$summary=$start.'-'.$count.' dari '.$count;
			else $summary=$start.'-'.$end.' dari '.$count;			
		}
		//var_dump($pages);exit;
		$this->render('adminJakartaSales',array(
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
		$model=ItemHistory::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
