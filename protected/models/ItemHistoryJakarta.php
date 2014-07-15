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
		$sqlGudang= 'SELECT gud.item_code, gud.name, gud.offer_price, (CASE WHEN s.sup_name IS NULL THEN gud.supplier ELSE s.sup_name END) AS supplier, gud.qty_in, gud.qty_stock, gud.date_in, DATEDIFF(gud.date_out, gud.date_in) AS period FROM item_history_gudang gud LEFT JOIN supplier s ON gud.supplier=s.sup_code';
		$sqlToko = 'SELECT item_code, sum(qty_stock) AS qty_stock, period FROM item_history';
		$conditionGudang=array();
		$conditionToko=array();
		$param=array();
		if(!empty($this->item_code))
		{
			$conditionGudang[]='gud.item_code LIKE :code';
			$conditionToko[]='gud.item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->sup_code))
		{
			$conditionGudang[]='gud.supplier = :sup';
			$param[':sup']=$this->sup_code;
		}
		if(!empty($this->month))
		{
			$conditionGudang[]='month(gud.date_in) = :month';
			$param[':month']=$this->month;
		}
		
		if(!empty($conditionGudang))
			$sqlGudang .= ' WHERE '.implode(' AND ', $conditionGudang);
		if(!empty($conditionToko))
			$sqlToko .= ' WHERE '.implode(' AND ', $conditionToko);
		
		$sqlToko .= ' GROUP BY item_code';
		
		$sql = 'SELECT g.item_code, g.name, g.supplier, g.offer_price, t.qty_stock as stok_toko, t.period, g.qty_in, g.qty_stock as stok_gudang, (CASE (t.qty_stock+g.qty_stock) WHEN 0 THEN t.period + g.period ELSE DATEDIFF(NOW(),g.date_in) END) as periode
				FROM ('.$sqlGudang.') g LEFT JOIN ('.$sqlToko.') t on t.item_code=g.item_code';
		$sql .= ' ORDER BY g.'.$this->sortBy.' '.$this->sortType;
		$sql .= ' LIMIT '.$this->start.', '.$this->size;
		//echo $sql;exit;
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