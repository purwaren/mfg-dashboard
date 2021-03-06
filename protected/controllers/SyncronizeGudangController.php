<?php

class SyncronizeGudangController extends Controller
{
	public function beforeAction($action)
	{
		//echo CJSON::encode($_SERVER);exit;
		//if(Yii::app()->request->isSecureConnection)
		//{
			if($this->authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
			{
				
				return TRUE;
			}
			else
			{
				echo CJSON::encode(array(
					'status' => 'error',
					'message' => 'Authorization failed',
				)),
				Yii::app()->end();
			}
		//}
		//else
		//{
		//	echo CJSON::encode(array(
		//		'status'=>'error',
		//		'message'=>'You are not using secure connection, request denied'
		//	));
		//}
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	/**
	 * Sinkronisasi
	 */
	public function actionSyncItemDistribution()
	{
		if(Yii::app()->request->isPostRequest)
		{
			//jika sudah ada data, tinggal insert atau update saja
			if(isset($_POST['data']))
			{
				$data=CJSON::decode($_POST['data']);
				$status=true;$saved=0;$error=array();
				foreach($data as $row)
				{
					$item = ItemDistribution::model()->findByAttributes(array(
							'item_code'=>$row['item_code'],
							'shop_code'=>$row['shop_code'],
					));
					if(empty($item))
					{
						$item = new ItemDistribution();
					}
				
					$item->item_code = $row['item_code'];
					$item->shop_code = $row['shop_code'];
					$item->qty_total = $row['qty'];
					$item->date_dist = $row['dist_out'];
				
					if($item->save())
						$saved++;
					else
					{
						$status=false;
						$error[]=$item->getErrors();
						$error[]=$item->attributes;
					}
				}
				if($status)
					echo CJSON::encode(array(
							'status'=>'ok'
					));
				else echo CJSON::encode(array(
						'status'=>'error',
						'message'=>$error
				));
			}
			//jika belum, kasih tahu dari tanggal berapa data yang belum masuk, kasih spare 1 minggu
			else 
			{
				$last=ItemDistribution::model()->findLastSyncDate();
				if(empty($last))
					echo CJSON::encode(array(
						'last_sync'=>0,
						'status'=>'ok'
					));
				else 
					echo CJSON::encode(array(
							'last_sync'=>$last->date_dist,
							'status'=>'ok'
					));
			}			
		}
	}
	
	public function actionSyncSupplier()
	{
		if(Yii::app()->request->isPostRequest)
		{
			//jika sudah ada data langsung simpan saja
			if(isset($_POST['data']))
			{
				$data=CJSON::decode($_POST['data']);
				$status=true;$saved=0;$error=array();
				foreach($data as $row)
				{
					$sup = Supplier::model()->findByAttributes(array(
							'sup_code'=>$row['sup_code'],
					));
					if(empty($sup))
					{
						$sup = new Supplier();
					}
				
					$sup->sup_code = $row['sup_code'];
					$sup->sup_name = $row['sup_name'];
					$sup->sup_address = $row['sup_address'];
					$sup->sup_phone = $row['sup_phone'];
					$sup->sup_type = $row['sup_type'];
					$sup->op_code = $row['op_code'];
					$sup->entry_date = $row['entry_date'];
				
					if($sup->save())
						$saved++;
					else
					{
						$status=false;
						$error[]=$item->getErrors();
						$error[]=$item->attributes;
					}
				}
				if($status)
					echo CJSON::encode(array(
							'status'=>'ok'
					));
				else echo CJSON::encode(array(
						'status'=>'error',
						'message'=>$error
				));
			}
			//jika belum ada data cek tanggal terakhir yang disinkronisasi	
			else 
			{
				$last=Supplier::model()->findLastSyncDate();
				if(empty($last))
					echo CJSON::encode(array(
							'last_sync'=>0,
							'status'=>'ok'
					));
				else
					echo CJSON::encode(array(
							'last_sync'=>$last->entry_date,
							'status'=>'ok'
					));
			}		
		}
	}
	
	public function actionSyncItemHistory()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$data=CJSON::decode($_POST['data']);
			$status=true;$saved=0;$error=array();
			foreach($data as $row)
			{
				$item = ItemHistoryGudang::model()->findByAttributes(array(
					'item_code'=>$row['item_code']
				));
				if(empty($item))
				{
					$item = new ItemHistoryGudang();
				}
				
				$item->item_code = $row['item_code'];
				$item->name=$row['name'];
				$item->supplier=$row['supplier'];
				$item->capital_price=$row['capital_price'];
				$item->offer_price=$row['offer_price'];
				$item->date_in=$row['date_in'];
				$item->date_out=$row['date_out'];
				$item->date_bon=$row['date_bon'];
				$item->qty_in=$row['qty_in'];
				$item->qty_stock=$row['qty_stock'];
				$item->qty_dist=$row['qty_dist'];				
				
				if($item->save())
					$saved++;
				else
				{
					$status=false;
					$error[]=$item->getErrors();
					$error[]=$item->attributes;
				}
			}
			if($status)
				echo CJSON::encode(array(
						'status'=>'ok'
				));
			else echo CJSON::encode(array(
					'status'=>'error',
					'message'=>$error
			));
		}
	}
}