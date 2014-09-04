<?php
class ItemJakartaSales extends CFormModel
{	
	public $item_code;
	public $start_date;
	public $end_date;
	public $store_code;
	public $start=0;
	public $size=10;
	
	public function rules()
	{
		return array(
			array('item_code, start_date, end_date, store_code','safe')
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'item_code'=>'Kelompok Barang',
			'start_date'=>'Periode',
			'store_code'=>'Toko Cabang'
		);
	}
	
	public function searchUniqueItem()
	{
		$sql = 'SELECT SUBSTR(item_code,1,3) AS kelompok, SUM(qty_in) AS total_in, 
				SUM(qty_sold) AS total_sold, SUM(qty_stock) AS total_stock FROM item_history';
		
		$params=array();
		$condition=array();
		if(!empty($this->item_code))
		{
			$condition[] = 'SUBSTR(item_code,1,3) = :item_code';
			$params[':item_code'] = $this->item_code;
		}
		if(!empty($this->start_date))
		{
			$condition[] = 'date_in >= :start_date';
			$params[':start_date'] = $this->start_date;
		}
		if(!empty($this->end_date))
		{
			$condition[] = 'date_in <= :end_date';
			$params[':end_date'] = $this->end_date;
		}
		if(!empty($this->store_code))
		{
			$condition[] = 'store_code = :store_code';
			$params[':store_code'] = $this->store_code;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$sql .= ' GROUP BY kelompok';
		$sql .= ' ORDER BY kelompok';
		$sql .= ' LIMIT '.$this->start.','.$this->size;
		
		$cmd = Yii::app()->db->createCommand($sql);
		return $cmd->queryAll(true, $params);
	}
	
	public function countUniqueItem()
	{
		$sql = 'SELECT SUBSTR(item_code,1,3) AS kelompok FROM item_history';
		
		$params=array();
		$condition=array();
		if(!empty($this->item_code))
		{
			$condition[] = 'SUBSTR(item_code,1,3) = :item_code';
			$params[':item_code'] = $this->item_code;
		}
		if(!empty($this->start_date))
		{
			$condition[] = 'date_in >= :start_date';
			$params[':start_date'] = $this->start_date;
		}
		if(!empty($this->end_date))
		{
			$condition[] = 'date_in <= :end_date';
			$params[':end_date'] = $this->end_date;
		}
		if(!empty($this->store_code))
		{
			$condition[] = 'store_code = :store_code';
			$params[':store_code'] = $this->store_code;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$sql .= ' GROUP BY kelompok';
		
		$sql = 'SELECT COUNT(*) FROM ('.$sql.') t1';
		
		$cmd = Yii::app()->db->createCommand($sql);
		return $cmd->queryScalar($params);
	}
	
	
}