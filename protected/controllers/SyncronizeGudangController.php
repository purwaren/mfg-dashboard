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
	 * Syncronize item_distribution from sisgud
	 */
	public function actionSyncItemDistribution()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$data = CJSON::decode($_POST['data']);
			$sync_time = $_POST['sync_time'];			
			
			$i=0;
			foreach($data as $row)
			{
				$i++;
				$item_dist = ItemDistribution::model()->findByAttributes(array(
					'item_code'=>$row['item_code'],
					'store_code'=>$row['shop_code']
				));
				//new items, item already exist was not processed
				if(empty($item_dist))
				{
					$item = Items::model()->findByAttributes(array(
						'code'=>$row['item_code']
					));
					
					if(empty($item))
					{
						$item = new Items();
						$item->code = $row['item_code'];
						$item->name = $row['item_name'];
						$item->hm = $row['item_hm'];
						$item->hp = $row['item_hp'];
						$item->hj = $row['item_hj'];
						$item->total = 0;
						$item->stock = 0;
						$item->cat = $row['cat_code'];
						$item->sup = $row['sup_code'];
						$item->sync_time = $sync_time;
					}
					else
					{
						$item->total += $row->quantity;
					}
					
					$item_dist = new ItemDistribution();
					$item_dist->item_code = $row['item_code'];
					$item_dist->store_code = $row['shop_code'];
					$item_dist->dist_code = $row['dist_code'];
					$item_dist->dist_date = $row['dist_out'];
					$item_dist->qty = $row['quantity'];
					$item_dist->status = 0;
					
					if($item->save())
						$item_dist->save();
				}				
			}
			if($i==count($data))
				echo CJSON::encode(array(
					'status'=>'ok',
					'message'=>'Success upload'
				));
			else
				echo CJSON::encode(array(
					'status'=>'error',
					'message'=>'Error saving'
				));
		}
		else
		{
			echo CJSON::encode(array(
				'status'=>'error',
				'message'=>'Only post request allowed'
			));
		}
	}

}