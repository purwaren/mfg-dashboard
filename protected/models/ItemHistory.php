<?php

/**
 * This is the model class for table "item_history".
 *
 * The followings are the available columns in table 'item_history':
 * @property integer $id
 * @property string $item_code
 * @property string $name
 * @property double $price
 * @property string $date_in
 * @property integer $qty_in
 * @property integer $qty_sold
 * @property integer $qty_stock
 * @property integer $period
 * @property string $store_code
 */
class ItemHistory extends CActiveRecord
{
	public $start=0;
	public $size=10;
	public $sortBy='item_code';
	public $sortType = 'ASC';
	public $total;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ItemHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_code, name, price, date_in, qty_in, qty_sold, qty_stock, period, store_code', 'required'),
			array('qty_in, qty_sold, qty_stock, period', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('item_code', 'length', 'max'=>15),
			array('name', 'length', 'max'=>128),
			array('store_code', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_code, name, price, date_in, qty_in, qty_sold, qty_stock, period, store_code, sortBy, sortType', 'safe', 'on'=>'search'),
		);
	}
	
	public function scopes()
	{
		return array(
			'hist'=>array(
				'order'=>'store_code ASC'
			),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'store'=>array(self::BELONGS_TO,'Store','store_code')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_code' => 'Kode Barang',
			'name' => 'Nama',
			'price' => 'Harga',
			'date_in' => 'Tgl Masuk',
			'qty_in' => 'Masuk',
			'qty_sold' => 'Jual',
			'qty_stock' => 'Stok',
			'period' => 'Periode',
			'store_code' => 'Toko',
			'sortBy'=>'Urut Berdasarkan',
			'sortType'=>'Urutkan Dari'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('qty_in',$this->qty_in);
		$criteria->compare('qty_sold',$this->qty_sold);
		$criteria->compare('qty_stock',$this->qty_stock);
		$criteria->compare('period',$this->period);
		$criteria->compare('store_code',$this->store_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchUniqueItem()
	{
		$criteria=new CDbCriteria;		
		$sql = 'SELECT  item_code, name, date_in, price, sum(qty_stock) AS total FROM item_history';
		$condition=array();
		$param=array();
		if(!empty($this->item_code))
		{
			$condition[]='item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->date_in))
		{
			$condition[]='date_in = :date';
			$param[':date']=$this->date_in;
		}

		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$sql .= ' GROUP BY item_code HAVING sum(qty_stock)>0 
				ORDER BY '.$this->sortBy.' '.$this->sortType.' 
				LIMIT '.$this->start.', '.$this->size;
		//var_dump($sql);
		
		return self::model()->findAllBySql($sql,$param);

	}
	
	public function countUniqueItem()
	{
		$criteria=new CDbCriteria;
		$sql = 'SELECT count(*) FROM (SELECT * FROM item_history';
		$condition=array();
		
		$param=array();
		if(!empty($this->item_code))
		{
			$condition[]='item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->date_in))
		{
			$condition[]='date_in = :date';
			$param[':date']=$this->date_in;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);	
		$sql .= ' GROUP BY item_code) t1';

		return self::model()->countBySql($sql,$param);
	}
	
	public function summaryAllItem()
	{
		$sql='SELECT s.code AS store_code, SUM(i.qty_in) AS qty_in, SUM(i.qty_sold) AS qty_sold, 
			SUM(i.qty_stock) AS qty_stock FROM store s LEFT JOIN item_history i 
			ON s.code = i.store_code';
		
		$param=array();
		$condition=array();
		if(!empty($this->item_code))
		{
			$condition[]='i.item_code LIKE :code';
			$param[':code']=$this->item_code.'%';
		}
		if(!empty($this->date_in))
		{
			$condition[]='i.date_in = :date';
			$param[':date']=$this->date_in;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$sql .= ' GROUP BY s.code ORDER BY s.code';
		
		return self::model()->findAllBySql($sql);
	}
	
	public static function getAllSortOptions()
	{
		return array(
			'item_code'=>'Kode Barang',
			'total'=>'Quantity',
			'price'=>'Harga',			
		);
	}
	
	public static function getAllSortTypeOptions()
	{
		return array(
			'ASC'=>'Kecil ke Besar',
			'DESC'=>'Besar ke Kecil'
		);
	}
	
	public function getTanggalMasuk()
	{
		$month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli',
		'Agustus','September','Oktober','November','Desember');
		$tmp = explode('-',$this->date_in);
		
		
		return $tmp[2].' '.$month[intval($tmp[1])].' '.$tmp[0];
	}
}