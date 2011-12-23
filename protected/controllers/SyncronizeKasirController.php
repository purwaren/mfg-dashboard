<?php

class SyncronizeKasirController extends Controller
{
	
	public function beforeAction($action)
	{
		if(Yii::app()->request->isSecureConnection)
		{
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
		}
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
	
	/**
	 * Receiving and saving sales data
	 */
	public function actionSyncSales()
	{		
		if(Yii::app()->request->isPostRequest)
		{			
			$data = CJSON::decode($_POST['data']);
			$status = 1;
			foreach($data as $row)
			{
				//$this->var_dump($row);
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
				//$this->var_dump($sales->attributes);
				if($sales->save())
				{					
					$status = $status*1;
					//saving sales item
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
							$sale_items->disc = $item['diskon'];
							$sale_items->qty = $item['qty'];
							if($sale_items->save())							
								$status = $status*1;							
							else 
								$status = $status*0;
						}
					}
				}
				else $status = $status*0;
			}
			//
			if($status)
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