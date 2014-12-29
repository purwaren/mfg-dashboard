<?php

class SyncronizeKasirController extends Controller
{
	
	public function beforeAction($action)
	{
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
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionTest()
	{
		$this->var_dump($_POST);
	}

	/**
	 * Syncronize ip address from store
	 */
	public function actionSyncIp()
	{
		if(Yii::app()->request->isPostRequest)
		{
			//print_r($_POST);exit;
			$model = StoreIp::model()->findByAttributes(array(
				'store_code'=>$_POST['store_code'],
			));
			if(empty($model))
			{
				$model = new StoreIp();
			}
			$model->store_code = $_POST['store_code'];
			$model->name = $_POST['name'];
			$model->current_ip = $_SERVER['REMOTE_ADDR'];
			$model->last_updated = time();
			if($model->save())
			{
				echo CJSON::encode(array(
							'status'=>'OK'
				));
			}
			else
			{
				echo CJSON::encode(array(
							'status'=>'ERROR',
							'message'=>$model->getErrors()
				));
			}
		}
	}
	
	public function actionSyncRevenue()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = StoreRevenue::model()->findByAttributes(array(
				'store_code'=>$_POST['store_code'],
				'date'=>$_POST['tanggal']
			));
			if(empty($model))
			{
				$model = new StoreRevenue();
			}
			$model->store_code = $_POST['store_code'];
			$model->date = $_POST['tanggal'];
			$model->last_updated = time();
			$model->current_revenue = $_POST['revenue'];
			if($model->save())
			{
				echo CJSON::encode(array('status'=>'OK'));
			}
			else
			{
				echo CJSON::encode(array(
					'status'=>'ERROR',
					'message'=>$model->getErrors(),
				));
			}
		}
	}
	
	/**
	 * Receiving and saving store items data
	 */
	public function actionSyncStoreItems()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$data = CJSON::decode($_POST['data']);
			$i = 0;			
			foreach($data as $row)
			{
				$item = StoreItems::model()->findByAttributes(array(
					'store_code'=>$_POST['store_code'],
					'item_code'=>$row['id_barang']
				));
				if(!isset($item))
				{
					$item = new StoreItems();					
				}				
				//saving data
				$item->store_code = $_POST['store_code'];
				$item->item_code = $row['id_barang'];
				$item->price = $row['harga'];
				$item->total = $row['total_barang'];
				$item->init_stock = $row['stok_awal'];
				$item->stock = $row['stok_barang'];
				$item->opname_stock = $row['stok_opname'];
				$item->item_in = $row['mutasi_masuk'];
				$item->item_sold = $row['mutasi_keluar'];
				$item->disc = $row['diskon'];
				$item->total_sold = $row['jumlah_terjual'];
				$item->sync_time = $_POST['sync_time'];
				if($item->save())
					$i++;
			}
			if($i == count($data))
				echo CJSON::encode(array(
					'status'=>'ok'
				));
			else 
				echo CJSON::encode(array(
					'status'=>'error'
				));
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
				$item = ItemHistory::model()->findByAttributes(array(
					'item_code'=>$row['id_barang'],
					'store_code'=>$_POST['store_code']
				));
				if(empty($item))
				{
					$item = new ItemHistory();
				}
				
				$item->item_code=$row['id_barang'];
				$item->name=$row['nama'];
				$hj=trim($row['harga_jual']);
				$item->price=is_numeric($hj)?$hj:0;
				$item->date_in=$row['tgl_masuk'];
				$item->qty_in=$row['masuk'];
				$item->qty_sold=$row['jual'];
				$item->qty_stock=$row['stok'];
				$item->period=$row['periode'];
				$item->store_code=$_POST['store_code'];
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
	/**
	 * Receiving and saving sales data
	 */
	public function actionSyncSales()
	{		
		if(Yii::app()->request->isPostRequest)
		{	
			$data = CJSON::decode($_POST['data']);
			$status=true;
			$saved=array();$i=0;$error=array();
			foreach($data as $row)
			{
				$i++;
				
				$sales = Sales::model()->findByAttributes(array(
					'store_code'=>$_POST['store_code'],
					'kassa'=>$row['kassa'],
					'sales_id'=>$row['id_transaksi'],
				));
				if(!isset($sales))
				{
					$sales = new Sales();
				}
				//saving sales data
				$sales->store_code = $_POST['store_code'];
				$sales->kassa = $row['kassa'];
				$sales->sales_id = $row['id_transaksi'];
				$sales->sale_date = $row['tanggal'];
				$sales->amount = $row['total'];
				$sales->disc = $row['diskon'];
				$sales->cc = $row['no_cc'];
				$sales->teller_id = $row['id_kasir'];
				$sales->clerk_id = $row['id_pramuniaga'];
				$sales->sync_time = $_POST['sync_time'];
				
				if($sales->save())
				{					
					$saved[]=$sales->sales_id;
					$count = SaleItems::model()->countByAttributes(array(
						'id'=>$sales->id,
					));
					if($count != count($row['itp']))
					{
						SaleItems::model()->deleteAll('id = :id', array(':id'=>$sales->id));
						foreach($row['itp'] as $item)
						{
							$sale_items = new SaleItems();
							$sale_items->id = $sales->id;
							$sale_items->item_code = $item['id_barang'];
							$disc = trim($item['diskon']);
							$sale_items->disc = !empty($disc)?$item['diskon']:'0';
							$sale_items->qty = $item['qty'];
							if(!$sale_items->save())							
							{
								$status = false;
								$error[]=$sale_items->getErrors();						
							}
							
						}
					}
				}
				else $status=false;
			}
			
 			if($status)
 				echo CJSON::encode(array(
					'status'=>'ok'
				));
			else
			{
				if(count($saved) < $i)
				{
					echo CJSON::encode(array(
						'status'=>'error',
						'message'=>'Tidak semua transaksi tersimpan'
					));
				}
				else 
				{
					echo CJSON::encode(array(
							'status'=>'error',
							'message'=>'Tidak semua item transaksi tersimpan',
							'error'=>$error
					));
				}
			}				
		}
	}
	
	/**
	 * Receiving and saving item sold by shop
	 */
	public function actionSyncSoldItem()
	{
		if(Yii::app()->request->isPostRequest)
		{
			//jika sudah ada data, tinggal insert atau update saja
			if(isset($_POST['data']))
			{
				$data = CJSON::decode($_POST['data']);
				$status=true; $saved=0; $error=array();$update=0;
				foreach($data as $row)
				{
					$sold=SoldItem::model()->findByAttributes(array(
						'shop_code'=>$_POST['store_code'],
						'category'=>$row['kelompok_barang'],
						'trx_date'=>$row['tanggal']
					));
					if(empty($sold))
					{
						$sold=new SoldItem();
					}
					else 
						$update++;
					
					$sold->category=$row['kelompok_barang'];
					$sold->trx_date=$row['tanggal'];
					$sold->qty_in=$row['qty_masuk'];
					$sold->qty_sold=$row['qty_jual'];
					$sold->shop_code=$_POST['store_code'];
					if($sold->save())
						$saved++;
					else 
					{
						$status=false;
						$error[]=$sold->getErrors();
					}
				}
				
				//Yii::log('part: '.$_POST['part'].', saved: '.$saved.', updated: '.$update.', status: '.print_r($status,true));
				
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
				$last = SoldItem::model()->findLastSyncDate(array(
					':shop'=>$_POST['store_code']
				));
				if($last)
				{
					echo CJSON::encode(array(
						'last_sync'=>$last->trx_date,
						'status'=>'ok'
					));
				}
				else 
					echo CJSON::encode(array(
						'last_sync'=>0,
						'status'=>'ok'
					));
			}
		}
	}
	
	/**
	 * 
	 * Receiving and saving item retur
	 */
	public function actionSyncRetur()
	{		
		if(Yii::app()->request->isPostRequest)
		{
			$data = CJSON::decode($_POST['data']);
			$i=0;
			foreach($data as $row)
			{
				$retur = ItemRetur::model()->findByAttributes(array(
					'retur_id'=>$row['id_retur'],
					'store_code'=>$_POST['store_code'],
					'item_code'=>$row['id_barang'],
				));
				if(!isset($retur))
				{
					$retur = new ItemRetur;
				}
				
				//saving retur item
				$retur->retur_id = $row['id_retur'];
				$retur->store_code = $_POST['store_code'];
				$retur->item_code = $row['id_barang'];
				$retur->qty = $row['qty'];
				$retur->date = $row['tanggal'];	
				$this->var_dump($retur->attributes);			
				if($retur->save())
					$i++;
			}
			if($i == count($data))
				echo CJSON::encode(array(
					'status'=>'ok'
				));
			else 
				echo CJSON::encode(array(
					'status'=>'error'
				));
		}
	}
	
	/**
	 * Receiving and saving lost items
	 */
	public function actionSyncLostItems()
	{
		if(Yii::app()->request->isPostRequest)
		{			
			$data = CJSON::decode($_POST['data']);
			$i=0;
			//$this->var_dump($data);
			foreach($data as $row)
			{
				$lost = ItemLost::model()->findByAttributes(array(
					'store_code'=>$_POST['store_code'],
					'item_code'=>$row['id_barang'],
					'date'=>$row['tanggal'],
				));
				if(!isset($lost))
				{
					$lost = new ItemLost();
				}
				//saving data
				$lost->store_code = $_POST['store_code'];
				$lost->item_code = $row['id_barang'];
				$lost->date = $row['tanggal'];
				$lost->price = $row['harga_ganti'];
				$lost->qty = $row['qty'];
				//$this->var_dump($lost->attributes);
				if($lost->save())
					$i++;				
			}
			if($i == count($data))
				echo CJSON::encode(array(
					'status'=>'ok'
				));
			else 
				echo CJSON::encode(array(
					'status'=>'error'
				));
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $txt
	 */
	
	protected function writeLog($txt)
	{
		$handle = fopen('log.txt','a+');
		fwrite($handle, $txt.chr(10));
		fclose($handle);
	}
}