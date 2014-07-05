<?php
class ItemHistoryJakarta extends CFormModel
{
	public $sup_code;
	public $month;
	public $item_code;
	public $sortBy='item_code';
	public $sortType='ASC';
	public $start=0;
	public $size=10;
	
	public function rules()
	{
		return array(
			array('sortBy, sortType','required'),
			array('sup_code, month, item_code, sortBy','safe'),
		);		
	}
	
	public function attributeLabels()
	{
		return array(
			'sup_code'=>'Nama Supplier',
			'month'=>'Bulan Pembelian',
			'item_code'=>'Kode Barang',
			'sortBy'=>'Urut Berdasarkan',
			'sortType'=>'Urutkan Dari'
		);
	}
	
	public static function getAllSortOptions()
	{
		return array(
			'item_code'=>'Kode Barang',			
			'offer_price'=>'Harga',	
			'sup_name'=>'Nama Supplier'		
		);
	}
	
	public static function getAllSortTypeOptions()
	{
		return array(
			'ASC'=>'Kecil ke Besar',
			'DESC'=>'Besar ke Kecil'
		);
	}
	
	public function searchUniqueItem()
	{
		$sql = 'SELECT g.*,s.sup_name, 
				(CASE WHEN g.qty_stock>0 THEN DATEDIFF(NOW(), g.date_in) ELSE DATEDIFF(g.date_out,g.date_in) END) AS periode 
				FROM item_history_gudang g LEFT JOIN supplier s ON g.supplier=s.sup_code';
		$condition=array();
		$param=array();
		if(!empty($this->item_code))
		{
			$condition[]='g.item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->sup_code))
		{
			$condition[]='g.supplier = :sup';
			$param[':sup']=$this->sup_code;
		}
		if(!empty($this->month))
		{
			$condition[]='month(g.date_in) = :month';
			$param[':month']=$this->month;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		$sql .= ' ORDER BY '.$this->sortBy.' '.$this->sortType;
		$sql .= ' LIMIT '.$this->start.', '.$this->size;
		
		$cmd = Yii::app()->db->createCommand($sql);
		return $cmd->queryAll(true, $param);
	}
	
	public function countUniqueItem()
	{
		$sql = 'SELECT count(*) as total FROM item_history_gudang g';
		$condition=array();
		$param=array();
		if(!empty($this->item_code))
		{
			$condition[]='g.item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->sup_code))
		{
			$condition[]='g.supplier = :sup';
			$param[':sup']=$this->sup_code;
		}
		if(!empty($this->month))
		{
			$condition[]='month(g.date_in) = :month';
			$param[':month']=$this->month;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$cmd = Yii::app()->db->createCommand($sql);
		return $cmd->queryScalar($param);
	}
	
	public function summaryAllItem()
	{
		
	}
}